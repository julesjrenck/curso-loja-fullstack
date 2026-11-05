# Aula 7.78 — Controller da consulta administrativa

Implementação, explicação e verificações em 05/11/2026, após confirmação da
[7.77](07-77-contrato-consulta-administracao.md) com "entendi".
Checkpoint anterior publicado e conferido em
fb1147977c033aefaf3e7173d446f7be4450a5af; HEAD/origin/main/main remota iguais.
Entendimento da 7.78 confirmado com "entendi" em 05/11/2026; publicação
conferida em e853f90a5f1158ad0497ff011c23827f4806f434, HEAD/origin/main/main remota iguais.
Registro atualizado após publicação. Na 7.78, controller criado ainda sem rota;
integração pertence à etapa seguinte.

## Objetivo e arquivo

Criamos somente
[AdministracaoController.php](../../backend/app/Http/Controllers/Api/V1/AdministracaoController.php)
na aplicação. O método show produz a resposta de sucesso do
[contrato](../api/administracao.md); a autenticação e o Gate serão exigidos
pela futura rota em uma etapa própria.

O namespace App\Http\Controllers\Api\V1 acompanha o diretório dos demais
controllers da API. O import Controller permite estender a classe-base do
projeto; o import Illuminate\Http\JsonResponse nomeia o tipo retornado.
A classe é AdministracaoController e seu método público show não recebe
parâmetros porque esta mensagem fixa não depende de dados de entrada.

## Método implementado

```php
public function show(): JsonResponse
{
    return response()->json([
        'data' => [
            'mensagem' => 'Bem-vindo à administração da loja.',
        ],
    ]);
}
```

JsonResponse declara o tipo de objeto retornado pelo método. O helper
response()->json constrói a resposta JSON a partir do array associativo,
configurando Content-Type application/json. Sem outro status informado,
usa 200, conferido na verificação desta aula.

Data é a chave externa do envelope; seu valor é outro objeto com somente
mensagem. Não serializamos um model User para produzir esse texto. Não há
consulta ao banco, mudança de permissões ou necessidade de um Form Request
para receber campos, pois o método não lê dados do pedido.

Referência: [respostas JSON no Laravel](https://laravel.com/docs/13.x/responses#json-responses).

## Chamada direta e seus limites

O diagnóstico inicializou o Laravel em testing, exigiu configuração sem
cache/sqlsrv/loja_test e preparou a conexão padrão com SQL bloqueado por
beforeExecuting. Resolveu o controller pelo container e chamou:

```php
$resposta = $app->make(AdministracaoController::class)->show();
```

Make resolve uma instância da classe pelo container. Show executa o método
diretamente. Isso não envia uma requisição HTTP nem passa pelos middlewares
de uma rota. O objeto retornado informa como a resposta será enviada quando
a integração existir.

Sete controles passaram, código 0: classe JsonResponse, status 200,
Content-Type application/json, JSON decodificado exatamente igual ao contrato,
ausência de Location, zero tentativas SQL e PDO não aberto. Comparamos o
objeto JSON decodificado, sem depender de espaços ou escape de caracteres
Unicode no texto serializado. Saída somente booleanos, sem dados privados.

O diagnóstico não forneceu um usuário autenticado nem avaliou o Gate. Não
comprova 401/403 ou proteção administrativa. Por enquanto o controller é uma
classe disponível para futura integração; não há rota para chamá-lo via API.

## Comando e registros

```sh
docker compose exec -T backend php -l /app/app/Http/Controllers/Api/V1/AdministracaoController.php
```

Exec -T executa o PHP no backend sem terminal interativo. Php -l confere
sintaxe sem chamar show. Resultado: sem erros, código 0. O diagnóstico foi
enviado pela entrada padrão do PHP/Docker com APP_ENV testing somente no
processo, sem arquivo auxiliar ou alteração de configuração.

A verificação focada cobre a nova classe, que ainda não foi ligada às rotas.
Não acrescentamos testes permanentes nem repetimos a suíte: última execução
7.76, 112 testes/1.618 asserções. Sem SQL real, migration, login, promoção ou
requisição HTTP nesta etapa. Gate, User, rotas e OpenAPI preservados.

Atualizamos o contrato para distinguir controller verificado diretamente de
proteção HTTP ainda planejada; roteiro/progresso e continuidade da aula
anterior também atualizados.

## Continuidade

Entendimento confirmado com "entendi" em 05/11/2026. Continuidade iniciada na
[7.79](07-79-rota-administracao-protegida.md): registrar
GET /api/v1/administracao com auth:sanctum e can:acessar-administracao e
verificar pelo kernel HTTP os cenários 401/403/200 com usuários em memória.
Módulos 8 a 23 não iniciados.
