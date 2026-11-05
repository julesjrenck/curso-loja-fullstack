# Aula 7.58 — Origem do laboratório no Sanctum

Implementação, explicação e verificações em 05/11/2026, após confirmação da
7.57 com "entendi". Checkpoint anterior publicado e conferido em
1425d8a482a87c9020d01c627110134c75a8d2f3: HEAD/origin/main/main remota iguais.
Entendimento da 7.58 confirmado com "entendi" em 05/11/2026; publicação pendente.

## Objetivo e arquivo alterado

Criamos [backend/config/sanctum.php](../../backend/config/sanctum.php), único
arquivo de aplicação alterado. A origem de laboratório 8001 já estava permitida
no [CORS da 7.57](07-57-cors-origem-com-credenciais.md). Agora reconhecemos seu
host/porta no Sanctum, preservando o reconhecimento da API em 8002.

```php
<?php

use Laravel\Sanctum\Sanctum;

return [
    'stateful' => explode(',', env('SANCTUM_STATEFUL_DOMAINS', sprintf(
        '%s%s',
        'localhost,localhost:3000,127.0.0.1,127.0.0.1:8000,::1,127.0.0.1:8001',
        Sanctum::currentApplicationUrlWithPort(),
    ))),
];
```

Stateful significa que o fluxo mantém estado por sessão. A lista indica quais
interfaces próprias devem receber a preparação de sessão/cookies/CSRF pelo
middleware já ativado com statefulApi() no [bootstrap](../../backend/bootstrap/app.php).
Reconhecer a origem não cria uma identidade autenticada.

Aqui os itens são hosts com porta, sem protocolo ou caminho: 127.0.0.1:8001.
No CORS, declaramos a origem completa: http://127.0.0.1:8001.
Fonte: [domínios da interface própria no Sanctum](https://laravel.com/docs/13.x/sanctum#configuring-your-first-party-domains).

## Como o array é construído

use importa a classe Sanctum. currentApplicationUrlWithPort() extrai host e
porta de config('app.url'), acrescentando uma vírgula antes deles. No ambiente
atual, essa parte mantém 127.0.0.1:8002 na lista. Não fixamos 8002 no arquivo.

sprintf('%s%s', ...) concatena a lista base com essa parte da URL da aplicação.
Preservamos os hosts padrão do pacote e acrescentamos 127.0.0.1:8001.
explode(',', ...) separa o texto pelas vírgulas e produz o array esperado.

env('SANCTUM_STATEFUL_DOMAINS', ...) usa o segundo argumento como padrão quando
a variável não está definida. Se ela estiver definida, seu texto substitui a
lista padrão inteira. Conferimos que essa sobrescrita está ausente no ambiente
atual, sem imprimir variáveis ou conteúdo de .env. Nenhum .env foi alterado.

O SanctumServiceProvider instalado combina a configuração do pacote com a do
projeto. Assim, este arquivo pode declarar somente stateful; guard, expiration,
token_prefix e middleware continuam com seus valores anteriores do pacote.
A comparação efetiva confirmou isso, sem imprimir valores de token_prefix.

## Seleção em memória

Antes da alteração, a aplicação usava os padrões do pacote e Origin 8001
retornava false. Depois, construímos Requests em memória para o destino
http://127.0.0.1:8002/api/v1/usuario, sem executar a rota:

```php
$request = Illuminate\Http\Request::create(
    'http://127.0.0.1:8002/api/v1/usuario', 'GET', [], [], [],
    ['HTTP_ORIGIN' => 'http://127.0.0.1:8001'],
);
$recognized = Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::fromFrontend($request);
```

Request::create apenas monta o objeto. fromFrontend consulta a lista configurada,
sem executar a cadeia de middleware, iniciar sessão ou autenticar um usuário.
No código instalado, Referer tem preferência e Origin é usado como alternativa.

| Entrada, com destino sempre em 8002 | Reconhecida |
| --- | --- |
| Origin http://127.0.0.1:8001 | true |
| Origin http://127.0.0.1:8002 | true |
| Origin http://127.0.0.1:8003 | false |
| Sem Origin e sem Referer | false |
| Só Referer http://127.0.0.1:8001/laboratorio | true |

Nos cinco casos, o resultado correspondeu ao esperado e o Request permaneceu
sem sessão ou cookies. Isso verifica a seleção, sem executar login, consulta de
usuário, logout ou servidor HTTP. O diagnóstico contou zero eventos QueryExecuted.

## Verificações

```sh
docker compose exec -T backend php -l config/sanctum.php
docker compose exec -T backend php vendor/bin/phpunit --colors=never --do-not-cache-result
```

exec usa o container existente e -T dispensa terminal. php -l validou a sintaxe,
código 0. PHPUnit executou a suíte existente com saída sem cores e sem atualizar
o cache de resultados: 107 testes/1.586 asserções, código 0. Configuração de testes
mantida: testing/SQL Server loja_test/sessão e cache array. Nenhum teste novo.

O diagnóstico temporário também executou PHP pela entrada padrão do Docker.
Ambiente local, sem cache de configuração. Removeu apenas o novo host de uma
cópia em memória e comparou o resultado estritamente com a configuração do
pacote: igualdade e exatamente um item acrescentado conferidos. CORS e Sanctum
permaneceram iguais aos valores carregados antes dos cinco casos.

Zero SQL refere-se a esse diagnóstico; a suíte usou seu banco exclusivo de
integração normalmente. Saída limitada a booleanos, nomes dos casos e ambiente.
Não alteramos vendor, CORS, bootstrap, rotas, controllers, testes, ambientes,
dependências, serviços, migrations, Compose ou OpenAPI.

O fluxo completo de cookies e CSRF entre origens e o comportamento do navegador
ainda precisam de verificação própria. Nenhuma página de laboratório foi criada
nesta etapa.

Git diff --check passou. Seis links locais válidos; código PHP da aula igual
ao arquivo criado. Somente os cinco arquivos previstos alterados, índice vazio.

## Continuidade

Após confirmar entendimento e publicar, próxima 7.59: preparar uma página mínima
de laboratório em 8001 para GET /sanctum/csrf-cookie com Fetch e
credentials: 'include', sem login. Verificação no navegador acompanhada nas
etapas seguintes do módulo 7; módulos 8 a 23 não iniciados.
