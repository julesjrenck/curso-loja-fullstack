# Aula 6.77 — Validar a captura 422 da listagem

Implementação, explicação e verificação em 01/11/2026 após confirmação da
6.76 com "entendi" e publicação em c6bca3b7f142d82966a399073e6eff92661afa12.
Entendimento da 6.77 confirmado com "entendi" em 01/11/2026; publicação
verificada em 1be7f19f91f23aa2b4643b18795940331df176cf, referências local e remotas coincidentes.

## Objetivo e alteração

Em [validar-contrato-produto.sh](../../scripts/validar-contrato-produto.sh),
acrescentamos somente um caso ao case e atualizamos a mensagem de uso:

```bash
listagem:422)
  filtro_teste="test_retorna_422_em_json_para_pagina_invalida@zero"
  flag_captura="CAPTURAR_CONTRATO_LISTAGEM_422"
  caminho_api="/api/v1/produtos"
  ;;
```

Case compara a combinação operação:status recebida nos argumentos. O filtro
seleciona apenas a entrada zero do DataProvider; a flag ativa a captura da
6.76, restrita a page=0. Caminho_api indica a operação de listagem no OpenAPI.
O trecho existente arquivo_captura="${operacao}-${codigo_http}.json" produz
listagem-422.json. A mensagem de uso agora informa os quatro pares aceitos:
consulta 200/404 e listagem 200/422. Os padrões continuam consulta e status 404.

## Do teste à validação do schema

Executamos, com backend/SQL Server ativos e banco exclusivo de testes configurado:

```sh
bash scripts/validar-contrato-produto.sh 422 listagem
```

Bash no host controla Docker. Primeiro o script remove a captura anterior;
depois executa PHP/Artisan no backend com a flag, --do-not-cache-result e o
filtro escolhido. O teste faz GET /api/v1/produtos?page=0 e confere 422/JSON/
message/errors.page antes de gravar o corpo. Como o script limpa antes,
o teste acrescenta apenas a asserção dos bytes: 1 teste/9 asserções.
Set -e exige sucesso do teste antes de continuar.

O restante do fluxo já existe: PHP recebe status 422, caminho da listagem e
nome da captura por argv, lê o OpenAPI por STDIN e localiza application/json
da resposta 422. Exige schema e captura atual não vazia/legível/JSON válido.
Substitui somente example numa cópia integral temporária, preservando schemas,
components e referências. Redocly 2.65.0 com digest/config anteriores lê essa
cópia e a configuração em montagens somente leitura, sem rede. A regra
[no-invalid-media-type-examples](https://redocly.com/docs/cli/rules/oas/no-invalid-media-type-examples)
compara o exemplo ao schema correspondente. Mktemp/trap removem a pasta ao
encerrar, inclusive em falhas. Nenhuma nova dependência ou serviço.

O corpo capturado contém message texto e errors objeto; errors.page é uma
lista de textos. A frase produzida pelo Laravel é observada, sem fixá-la no
schema ou no teste. Esta etapa agora compara esse corpo ao contrato 422.

## Resultados

| Execução | Teste e validação |
| --- | --- |
| 422 listagem | 1/9; lint/processo 0 |
| 200 consulta, com operação padrão | 1/7; lint/processo 0 |
| Atalho 404 anterior | 1/7; lint/processo 0 |
| 200 listagem | 1/14; lint/processo 0 |
| 422 consulta e 404 listagem | Ambos código 2 antes de Docker |
| Cópia sem errors | Teste 1/9 passou; lint/processo 1 |
| Cópia com errors.page em texto | Teste 1/9 passou; lint/processo 1 |

Bash -n conferido separadamente nos dois scripts. Os dois diagnósticos em
/tmp/curso-677 são cópias do script, com raiz ajustada. Alteram somente example
no documento temporário: removem errors, ou trocam a lista errors.page pelo
texto do primeiro item. O validador apontou respectivamente errors obrigatório
e tipo array exigido para page. Nenhuma regra foi ignorada. Captura original,
backend e OpenAPI versionado permaneceram íntegros; temporários removidos após
sucesso e falhas. A captura 422 mantém 105 bytes e SHA256
8dab8e21482477f6b0a6b77d2241166d86848d7322f250fb51665982d8bde6d1.

A execução 422 preservou hashes dos outros três casos. As regressões depois
renovaram suas próprias capturas. SELECTs antes/depois: loja/loja_app
0 categorias/1 produto; loja_test/loja_testes 0 categorias/0 produtos. Captura
privada ignorada; diff/links conferidos. Backend/OpenAPI/configuração/atalho 404
inalterados. Sem nova suíte completa: última 6.76, 66 testes/620 asserções.

## Continuidade e alcance

O fluxo agora cobre um caso de cada resposta documentada: individuais 200/404
e listagem 200/422. Isso verifica os corpos desses casos com os schemas atuais;
as asserções de comportamento e os demais testes continuam necessários.
O limite do validador observado na 6.64 permanece registrado; id path original
mantém required true. Não iniciamos outro módulo.

Aula anterior registra publicação da 6.76; catálogo em português, roteiro e
progresso registram esta implementação, explicação e verificação. Entendimento
confirmado com "entendi" em 01/11/2026; publicação verificada. Depois de publicar,
iniciar somente 6.78: reunir os quatro casos já existentes em um único comando
de verificação do catálogo. Exercício DBeaver segue sem relato do aluno.

Continuidade realizada na [aula 06-78](06-78-comando-contratos-catalogo.md):
comando único para os quatro casos existentes.
