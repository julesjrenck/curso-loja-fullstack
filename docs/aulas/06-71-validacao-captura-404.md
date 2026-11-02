# Aula 6.71 — Validação da captura 404 contra OpenAPI

Implementação, explicação e verificação em 01/11/2026 após confirmação da
6.70 com "entendi" e publicação em a2055b62166a5976ac321411ad2332196d007ca6.
Entendimento da 6.71 confirmado com "entendi" em 01/11/2026; publicação em preparação.

## Um comando para o fluxo 404

Criado [validar-contrato-404.sh](../../scripts/validar-contrato-404.sh).
Com backend/sqlserver ativos e o ambiente de testes configurado, executamos
na raiz do repositório:

```sh
bash scripts/validar-contrato-404.sh
```

Bash controla os comandos Docker no host. PHP, teste HTTP e Redocly executam
nos containers. O fluxo fica limitado ao 404 de produto inexistente já estudado.

## Exigir uma captura da execução atual

O script começa com set -euo pipefail: -e interrompe os comandos diretos que
falham, -u recusa variáveis não definidas e pipefail considera falhas dentro de
pipelines. As regras estão no [manual do Bash](https://www.gnu.org/software/bash/manual/bash.html#The-Set-Builtin).
Cd resolve a raiz pela localização do script, usando BASH_SOURCE e dirname.

O primeiro comando PHP em Docker remove o arquivo de captura anterior, se
existir, e falha se não conseguir excluí-lo. Em seguida, executa o mesmo teste
com CAPTURAR_CONTRATO_404=1 e --do-not-cache-result. Somente depois de o teste
terminar com sucesso, o script continua.

Assim, uma captura antiga é removida mesmo se a execução seguinte não chegar
ao método de teste. O caso de negócio, as asserções e o isolamento em loja_test
continuam sendo os já implementados em CatalogoApiTest.

## Colocar o corpo no documento temporário

Mktemp -d cria uma pasta única em /tmp. Trap EXIT remove somente essa pasta
quando o processo termina, inclusive se o validador falhar.

Outro comando PHP, ainda no container backend, recebe o OpenAPI pela entrada
padrão. O trecho central é:

```php
$documento = json_decode(stream_get_contents(STDIN), false, 512, JSON_THROW_ON_ERROR);
$conteudo = $documento->paths->{"/api/v1/produtos/{id}"}->get->responses->{"404"}->content->{"application/json"} ?? null;
```

As propriedades entre chaves acessam nomes com barras ou um número, como
application/json e 404. O caminho usa o modelo {id} do contrato. Se o objeto
de conteúdo ou seu schema não existir, a preparação falha.

O script também exige que a captura exista, seja legível, não esteja vazia e
contenha JSON válido. Depois:

```php
$conteudo->example = json_decode($corpo, false, 512, JSON_THROW_ON_ERROR);
```

False preserva objetos JSON como objetos PHP e listas como arrays. Conteudo
aponta para um objeto dentro de documento; alterar sua propriedade example
atualiza aquele ponto do documento. Json_encode serializa a cópia completa,
mantendo schemas, components e referências internas como $ref de Produto.

No shell, < docs/api/openapi.json envia o documento versionado ao PHP; >
redireciona a saída JSON para openapi.json dentro da pasta temporária. O contrato
original é somente entrada e não é sobrescrito.

## Validar a cópia

O último comando usa a mesma imagem fixada por versão/digest:

```text
redocly/cli:2.65.0@sha256:42acee0d7e629a9d0376d8df579dc325e51da727de06a31036bccc02409a7e11
```

Docker run --rm --network none monta somente a cópia e redocly.yaml em /spec,
ambos somente para leitura. Workdir define /spec; lint openapi.json --config
redocly.yaml valida o documento e o corpo inserido pela regra
[no-invalid-media-type-examples](https://redocly.com/docs/cli/rules/oas/no-invalid-media-type-examples).

Status e Content-Type foram conferidos pelo teste; o corpo capturado é comparado
ao schema selecionado pelo Redocly. O código final do script deve ser 0 para
considerar o fluxo inteiro bem-sucedido.

## Verificações executadas

Bash -n conferiu a sintaxe. O script do projeto terminou com código 0:
teste HTTP com 1 teste/7 asserções, seguido de lint válido/código 0. A limpeza
inicial deixou o caso sem arquivo anterior; houve apenas a asserção adicional
de bytes, além das seis asserções normais.

Duas cópias de diagnóstico ficaram em /tmp/curso-671, fora do Git:

| Cópia | Resultado |
| --- | --- |
| Filtro sem nenhum teste | Código 1/No tests found; captura antiga removida, sem preparar ou validar documento |
| Remover message só do example temporário | Teste 1/7 passou; lint/script código 1, required message ausente |

A segunda rejeição veio da regra de exemplos. A captura persistida continuou
válida, com 42 bytes e o mesmo hash registrado na 6.70; apenas a cópia do
contrato foi adulterada no diagnóstico. Nenhuma regra foi ignorada. As pastas
temporárias de validação foram removidas ao terminar.

SELECTs posteriores confirmaram loja/loja_app com 0 categorias/1 produto e
loja_test/loja_testes com 0 categorias/0 produtos. Backend, OpenAPI e configuração
inalterados. Última suíte completa: 6.70, 66 testes/620 asserções; nesta etapa
executamos apenas o caso focado dentro do fluxo. Diff, links e ignore conferidos.

A cobertura atual é um caso 404 gerado pelo Laravel em teste HTTP interno.
Asserções de negócio continuam necessárias. A limitação de required false da
6.64 permanece registrada; id path mantém required true no documento.

## Continuidade

Contrato em português, roteiro e progresso atualizados. Entendimento confirmado
com "entendi" em 01/11/2026. Publicar o checkpoint. Próxima etapa, 6.72:
preparar captura optativa da resposta 200 no teste de consulta individual de
produto ativo, usando o ID produzido pela factory.
