# Aula 7.13 — Descoberta do Sanctum pelo Laravel

Execução, explicação e verificações em 04/11/2026, após confirmação da 7.12
com "entendi". Checkpoint anterior publicado e conferido em
99a131dcbcd43b504db45f3e279a783065c69a5d; HEAD/origin/main/main remota iguais
após push. Entendimento da 7.13 confirmado com "entendi" em 04/11/2026.

## Objetivo e conceito

Registrar no Laravel o pacote Sanctum v4.3.3 instalado na 7.11. O autoload
do Composer já encontrava suas classes, mas o provider ainda não constava
no manifest existente. Agora executamos a descoberta de forma explícita.

| Peça | Responsabilidade |
| --- | --- |
| Autoload PHP | Encontrar e carregar classes |
| Service provider | Registrar serviços e inicializar recursos do pacote no Laravel |
| Manifest de pacotes | Registrar quais pacotes declaram providers/aliases |

O próprio composer.json do Sanctum declara, em extra.laravel.providers,
Laravel\Sanctum\SanctumServiceProvider. A
[descoberta de pacotes](https://laravel.com/docs/13.x/packages#package-discovery)
usa esses metadados. Não precisamos acrescentar o provider em
[bootstrap/providers.php](../../backend/bootstrap/providers.php), que continua
listando nosso AppServiceProvider.

## Comando executado

```sh
docker compose exec -T backend php artisan package:discover --no-interaction --no-ansi
```

exec -T executa no backend ativo sem terminal interativo. package:discover
reconstrói o manifest com os metadados dos pacotes instalados. As opções finais
dispensam perguntas interativas e cores. O comando terminou com código 0.

Antes, packages.php tinha seis entradas, sem Sanctum. Depois, sete entradas,
incluindo o provider declarado pelo pacote. Essa contagem é dos pacotes com
integração descoberta, não dos 110 pacotes instalados pelo Composer.

A saída do comando listou somente os seis pacotes anteriores, comportamento
já observado na aula 5.33. O arquivo foi reconstruído, mas aquela instância
mantinha o manifest anterior em memória. Conferimos o arquivo gravado e
inicializamos outro processo para verificar o resultado efetivo.

## Arquivos gerados e carregamento

| Arquivo/local | Resultado |
| --- | --- |
| backend/bootstrap/cache/packages.php | Sete entradas; Sanctum aponta para SanctumServiceProvider |
| backend/bootstrap/cache/services.php | Provider consta nas listas providers e eager após novo bootstrap |
| Aplicação em novo processo | getLoadedProviders confirmou o provider carregado |
| [composer.json](../../backend/composer.json) e [lock](../../backend/composer.lock) | Hashes preservados; versões não mudaram |

Eager significa que esse provider é carregado na inicialização normal, em vez
de aguardar uma resolução adiada. Esses dois arquivos PHP de cache são gerados;
não os editamos manualmente nem os versionamos. No novo processo, o Laravel
reconstruiu o manifest de serviços para incluir o provider descoberto.

Conferimos os trechos relevantes de SanctumServiceProvider instalado. register
define suporte ao guard sanctum e mescla a configuração padrão do pacote.
boot registra a rota e configura o guard. Ele também declara recursos que
podem ser publicados, mas declarar esses recursos não os copia ou migra.
Não executamos vendor:publish nem migrations nesta etapa.

## Rota registrada

```sh
docker compose exec -T backend php artisan route:list --path=sanctum -vv --no-ansi
docker compose exec -T backend php artisan route:list --path=api/v1 -vv --no-ansi
```

A listagem mostrou:

```text
GET|HEAD sanctum/csrf-cookie
nome: sanctum.csrf-cookie
ação: Laravel\Sanctum\Http\Controllers\CsrfCookieController@show
middleware declarado: web
```

O provider define essa rota no código do pacote. Por isso ela apareceu sem
acrescentarmos uma linha em [routes/api.php](../../backend/routes/api.php).
O caminho de infraestrutura é /sanctum/csrf-cookie; as operações de negócio
continuam sob /api/v1.

O grupo web expandido inclui EncryptCookies, AddQueuedCookiesToResponse,
StartSession, ShareErrorsFromSession, PreventRequestForgery e SubstituteBindings.
As duas leituras do catálogo continuam apenas com SubstituteBindings e públicas.
O grupo api efetivo ainda não inclui EnsureFrontendRequestsAreStateful;
statefulApi continua ausente no [bootstrap](../../backend/bootstrap/app.php).

Registrar essa rota não cria nosso login nem demonstra uma resposta HTTP real.
A chamada para observar a preparação de sessão/CSRF será uma próxima etapa.

## Verificações

php -l nos dois manifests passou. O diagnóstico em novo processo confirmou a
entrada no manifest, provider em providers/eager e carregado na aplicação,
rota/nome/ação/métodos/middleware esperados e grupo api preservado.

A suíte existente em Docker passou: 67 testes/635 asserções, código 0, usando
--colors=never --do-not-cache-result. Ela confere os comportamentos já cobertos
com o provider ativo; não fizemos requisição ao novo endpoint nesta aula.

Hashes de composer.json e lock preservados antes/depois. Os manifests mudaram,
como esperado. Depois da suíte, consultas em loja_test/loja_testes confirmaram
seis tabelas, quatro migrations/lotes 1/2/3/4 e zero users/tokens/sessions/
produtos/categorias. Não aplicamos migrations ou criamos tabela de tokens pessoais.
Snapshot normal, auditoria e quatro contratos não foram repetidos. Última
auditoria continua a 7.12, código 0; não houve atualização de dependências aqui.

## Continuidade

Entendimento confirmado com "entendi" em 04/11/2026. Próximo passo após publicar:
7.14 — fazer uma primeira requisição HTTP controlada a GET /sanctum/csrf-cookie
para observar status e nomes/atributos dos cookies, sem fazer login.
Descoberta explicada/verificada e entendimento confirmado. Checkpoint preparado
para commit e push; consultar o Git ou registro posterior para conferir a publicação.
