# Aula 6.73 — Validar a captura 200 e compartilhar o fluxo

Implementação, explicação e verificação em 01/11/2026 após confirmação da
6.72 com "entendi" e publicação em bd05ce022b0c8af38a8a5fd2573c59757416603b.
Entendimento da 6.73 confirmado com "entendi" em 01/11/2026; publicação
verificada em 371ec884061be2107683da4e1f4afcbe98b36d4a, referências local e remotas coincidentes.

## Escolher o caso pelo argumento

A lógica da 6.71 passou para
[validar-contrato-produto.sh](../../scripts/validar-contrato-produto.sh).
Com backend/sqlserver ativos e ambiente de testes configurado, executamos:

```sh
bash scripts/validar-contrato-produto.sh 200
```

O argumento escolhe o caso de teste da consulta individual:

| Argumento | Caso | Arquivo de captura |
| --- | --- | --- |
| 200 | Produto ativo pelo ID da factory | consulta-200.json |
| 404 | Produto inexistente | consulta-404.json |

O script lê o primeiro argumento e aplica um padrão:

```bash
codigo_http="${1:-404}"
```

$1 é o primeiro argumento. A expressão usa 404 quando ele está ausente ou vazio.
Depois, case escolhe o filtro do teste:

```bash
case "$codigo_http" in
  200)
    filtro_teste="test_retorna_produto_ativo_pelo_id_em_json"
    ;;
  404)
    filtro_teste="test_retorna_404_em_json_para_id_inexistente"
    ;;
  *)
    printf 'Uso: bash scripts/validar-contrato-produto.sh [200|404]\n' >&2
    exit 2
    ;;
esac
```

É semelhante ao switch de PHP. Cada padrão escolhe um ramo; ;; encerra esse
ramo, *) trata os demais valores e esac fecha a estrutura. Printf escreve o
uso na saída de erros, e exit 2 interrompe antes de executar Docker. A sintaxe
segue o [manual do Bash](https://www.gnu.org/software/bash/manual/html_node/Conditional-Constructs.html).

## O mesmo status em cada parte

O status selecionado determina a flag de captura:

```bash
-e "CAPTURAR_CONTRATO_${codigo_http}=1"
```

O filtro seleciona o teste correspondente. Os dois trechos PHP recebem o status
depois do código passado a php -r. Dentro do PHP, $argv[1] lê esse argumento,
conforme a [documentação PHP](https://www.php.net/manual/en/reserved.variables.argv.php).

Na limpeza inicial, ele compõe o caminho consulta-200.json ou consulta-404.json.
Na preparação da cópia, também seleciona a resposta no OpenAPI:

```php
$codigoHttp = $argv[1];
$conteudo = $documento->paths->{"/api/v1/produtos/{id}"}->get->responses->{$codigoHttp}->content->{"application/json"} ?? null;
```

Assim, teste, flag, arquivo e schema correspondem ao mesmo caso. No 200, data
referencia Produto; o corpo capturado deve respeitar seus campos e tipos.

O restante do fluxo permanece: remover captura anterior, exigir sucesso do
teste, preparar cópia integral temporária alterando apenas example, preservar
schemas/components e validar com Redocly fixado. Os arquivos são montados somente
para leitura, o validador executa sem rede e trap remove os temporários.
Bash controla Docker no host; PHP, teste e validação executam nos containers.

## Atalho 404 preservado

[Validar-contrato-404.sh](../../scripts/validar-contrato-404.sh) agora delega:

```bash
bash "$(dirname "${BASH_SOURCE[0]}")/validar-contrato-produto.sh" 404
```

Ele localiza o script comum na mesma pasta e fornece 404. O comando anterior
continua funcionando e foi executado nesta etapa:

```sh
bash scripts/validar-contrato-404.sh
```

O script comum também aceita 404 diretamente; sem argumento, usa esse padrão.

## Resultados observados

Bash -n foi executado separadamente nos dois arquivos e passou.

| Execução | Resultado |
| --- | --- |
| Fluxo compartilhado com 200 | Teste 1/7, lint/script código 0 |
| Atalho anterior com 404 | Teste 1/7, lint/script código 0 |
| Status 500 | Código 2 antes de Docker |
| Cópia de diagnóstico com preço texto no exemplo 200 | Teste 1/7 passou; lint/script código 1 |

O último diagnóstico usou uma cópia em /tmp/curso-673 e converteu o preço
somente no example do documento temporário. Redocly rejeitou string "4990"
porque Produto exige integer, pela regra no-invalid-media-type-examples.
A captura original continuou com preço inteiro 4990; seu ID observado foi
22783, e seu tamanho, 64 bytes. Nenhuma regra foi ignorada. As pastas
temporárias do fluxo compartilhado foram removidas ao terminar.

SELECTs posteriores confirmaram loja/loja_app com 0 categorias/1 produto e
loja_test/loja_testes com 0 categorias/0 produtos. Backend, OpenAPI, configuração
e dependências inalterados. Última suíte completa: 6.72, 66 testes/620 asserções;
nesta etapa executamos os casos focados do fluxo. Diff, links e ignore conferidos.

A cobertura de corpos capturados agora inclui os casos individuais 200 e 404.
A limitação do validador observada na 6.64 continua registrada; id path mantém
required true. Asserções de negócio continuam necessárias.

## Continuidade

Contrato em português, roteiro e progresso atualizados. Entendimento confirmado
com "entendi" em 01/11/2026 e checkpoint publicado. Continuidade realizada na
[aula 06-74](06-74-captura-listagem-200.md): captura optativa de 200 da listagem
no teste HTTP de produto ativo.
