# Aula 6.78 — Um comando para os contratos do catálogo

Implementação, explicação e verificação em 01/11/2026 após confirmação da
6.77 com "entendi" e publicação em 1be7f19f91f23aa2b4643b18795940331df176cf.
Entendimento da 6.78 confirmado com "entendi" em 01/11/2026; publicação em preparação.

## Objetivo e novo arquivo

Criamos [validar-contratos-catalogo.sh](../../scripts/validar-contratos-catalogo.sh)
para executar os quatro casos já implementados, em sequência:

```bash
#!/usr/bin/env bash
set -euo pipefail

cd "$(dirname "${BASH_SOURCE[0]}")/.."

bash scripts/validar-contrato-produto.sh 200 consulta
bash scripts/validar-contrato-produto.sh 404 consulta
bash scripts/validar-contrato-produto.sh 200 listagem
bash scripts/validar-contrato-produto.sh 422 listagem

printf 'Contratos do catálogo: quatro casos validados.\n'
```

A primeira linha indica Bash como interpretador. Usamos bash ao invocar o
arquivo, como nos scripts anteriores; não precisamos mudar permissões.
Set -e encerra este fluxo se uma das chamadas falhar. Set -u trata variável
não definida como erro; pipefail considera falhas em pipelines. São as mesmas
opções dos scripts anteriores, embora este arquivo não tenha pipeline.

BASH_SOURCE[0] identifica este script; dirname obtém sua pasta e /.. aponta
para a raiz do projeto. Cd muda para essa raiz antes das chamadas, permitindo
iniciar o comando também a partir de outro diretório. Aspas preservam caminhos
com espaços. Falha no cd também impede continuar.

Cada chamada usa o [script compartilhado](../../scripts/validar-contrato-produto.sh),
com status e operação explícitos. Ele continua responsável por limpar a captura,
executar o teste em Docker, exigir sucesso, preparar a cópia integral do OpenAPI,
substituir somente example, validar com Redocly fixado/RO/sem rede e remover
temporários. O novo arquivo organiza a sequência; a lógica de cada caso fica
concentrada no script compartilhado. As chamadas são sequenciais e mantêm o
isolamento dos testes no banco loja_test.

Printf escreve a mensagem final apenas se as quatro chamadas tiverem terminado
com sucesso. Se alguma falhar, o processo termina com erro e não anuncia a
conclusão dos quatro casos. Capturas de casos anteriores podem permanecer no
storage; sucesso do comando depende da execução atual de todos os casos.

## Execução e resultados

Com backend/SQL Server ativos, banco exclusivo de testes configurado e imagem
do validador disponível, na raiz do repositório executamos:

```sh
bash scripts/validar-contratos-catalogo.sh
```

Bash no host controla Docker; PHP, testes e Redocly continuam nos containers.
Não há argumentos obrigatórios: os quatro pares estão definidos no arquivo.
Também executamos o arquivo real pelo caminho absoluto a partir de /tmp,
conferindo o cd para a raiz. O processo terminou com código 0 e a mensagem final.

| Caso, na ordem de execução | Teste focado | Validação |
| --- | --- | --- |
| Consulta 200 | 1 teste/7 asserções | Código 0 |
| Consulta 404 | 1/7 | Código 0 |
| Listagem 200 | 1/14 | Código 0 |
| Listagem 422, entrada zero | 1/9 | Código 0 |

São quatro execuções focadas, não a suíte completa. As quatro capturas foram
renovadas e conferidas via PHP Docker: consulta 200 com data, consulta 404 com
message, listagem 200 com data/links/meta, listagem 422 com message/errors.
Tamanhos observados: 64/42/586/105 bytes; JSON válido, hashes conferidos e arquivos
ignorados pelo Git. Pastas temporárias do fluxo removidas ao final.

## Conferir a interrupção por falha

Em /tmp/curso-678, copiamos o novo script e substituímos apenas o script chamado
por um simulador Bash. Ele registra os pares recebidos e retorna código 23 na
segunda chamada, 404 consulta. Não usa Docker nem altera a aplicação.

O comando de diagnóstico terminou com código 23, sem mensagem final. O registro
teve somente 200 consulta e 404 consulta: as duas listagens não foram iniciadas.
Isso confere a propagação da falha e a ordem das chamadas no novo arquivo.
Os testes anteriores das 6.75/6.77 já conferiram rejeição de exemplos inválidos
pelo validador real; o diagnóstico desta etapa examina o fluxo do Bash.

## Registro e continuidade

Bash -n passou no novo script. SELECTs antes/depois: loja/loja_app
0 categorias/1 produto; loja_test/loja_testes 0 categorias/0 produtos. Backend,
OpenAPI/configuração, scripts anteriores e dependências intactos. Diff e links
conferidos. Sem nova suíte completa; última 6.76, 66 testes/620 asserções.
Aula anterior registra a publicação da 6.77. Catálogo em português, roteiro e
progresso registram esta etapa. Limite do validador observado na 6.64 mantido:
quatro casos aprovados não demonstram todas as possíveis respostas da API.

Entendimento confirmado com "entendi" em 01/11/2026; publicação em preparação.
Depois de publicar, iniciar somente 6.79: documentar no README os pré-requisitos e os
comandos da suíte Laravel e da validação de contratos. Não iniciado módulo 7.
Exercício DBeaver segue sem relato do aluno.
