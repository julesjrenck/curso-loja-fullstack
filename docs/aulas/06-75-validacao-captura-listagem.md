# Aula 6.75 — Validar a captura 200 da listagem

Implementação, explicação e verificação em 01/11/2026 após confirmação da
6.74 com "entendi" e publicação em 8e19c0c18b38e41adb08a0cd62536eb3d8f5f839.
Entendimento da 6.75 confirmado com "entendi" em 01/11/2026; publicação
verificada em d3c76b255a91948809c7eac43561f2d840c507ef, referências local e remotas coincidentes.

## Escolher a operação além do status

Alteramos somente o código de
[validar-contrato-produto.sh](../../scripts/validar-contrato-produto.sh).
Agora executamos:

```sh
bash scripts/validar-contrato-produto.sh 200 listagem
```

O primeiro argumento continua sendo o status; o segundo escolhe a operação.
A consulta individual e a listagem têm resposta 200, com formatos diferentes.
Por isso, o status sozinho não determina qual schema comparar.

```bash
codigo_http="${1:-404}"
operacao="${2:-consulta}"
flag_captura="CAPTURAR_CONTRATO_${codigo_http}"
caminho_api="/api/v1/produtos/{id}"
```

Sem segundo argumento, a operação continua sendo consulta; sem argumentos,
continua consulta 404. A expressão ${2:-consulta} usa consulta como padrão.
Case agora compara a combinação "$operacao:$codigo_http". Nos casos consulta:200
e consulta:404, conserva os testes anteriores. Acrescentamos:

```bash
listagem:200)
  filtro_teste="test_retorna_produto_ativo_em_json"
  flag_captura="CAPTURAR_CONTRATO_LISTAGEM_200"
  caminho_api="/api/v1/produtos"
  ;;
```

O caso escolhe o teste de listagem, sua flag e o caminho sem {id}. Após case,
arquivo_captura="${operacao}-${codigo_http}.json" produz listagem-200.json.
Combinações não previstas saem com código 2 antes do Docker; 404 listagem ainda
não é um caso deste fluxo. O atalho validar-contrato-404.sh permanece igual.

## Reutilizar a captura atual e a cópia temporária

A limpeza prévia recebe arquivo_captura como $argv[1] no PHP e remove somente
esse arquivo privado. O teste roda com -e "${flag_captura}=1", filtro escolhido
e --do-not-cache-result, sempre dentro do backend Docker. Set -e interrompe o
fluxo se o teste falhar, evitando validar uma execução que não passou.

O segundo trecho PHP agora recebe três argumentos:

```php
$codigoHttp = $argv[1];
$caminhoApi = $argv[2];
$nomeCaptura = $argv[3];
$documento = json_decode(stream_get_contents(STDIN), false, 512, JSON_THROW_ON_ERROR);
$conteudo = $documento->paths->{$caminhoApi}->get->responses->{$codigoHttp}->content->{"application/json"} ?? null;
```

Bash passa status, caminho da operação e nome do arquivo, nessa ordem. STDIN
continua recebendo docs/api/openapi.json. O acesso dinâmico usa esses valores
para encontrar application/json da operação correta; ausência de schema provoca
erro. A captura é lida de storage privado, com rejeição de arquivo ausente,
ilegível, vazio ou JSON inválido. Conservamos:

```php
$conteudo->example = json_decode($corpo, false, 512, JSON_THROW_ON_ERROR);
```

Somente example muda na cópia integral temporária. Schema, referências e
components permanecem os mesmos; o arquivo OpenAPI versionado não é regravado.
O corpo capturado conserva data em lista, links e meta/meta.links.

Redocly continua na imagem 2.65.0 com o digest já fixado, sem rede, lendo a cópia
e a configuração em montagens somente leitura. A regra
[no-invalid-media-type-examples](https://redocly.com/docs/cli/rules/oas/no-invalid-media-type-examples)
compara o exemplo ao schema correspondente, incluindo suas referências.
Mktemp/trap continuam removendo a pasta temporária ao terminar, inclusive com erro.
Bash no host controla Docker; PHP e o validador executam nos containers.

## Verificações realizadas

| Execução | Resultado |
| --- | --- |
| Bash -n em cada um dos dois scripts, separadamente | Sintaxe válida |
| 200 listagem | Teste 1/14; lint e processo 0 |
| 200, sem segundo argumento | Consulta individual 1/7; lint e processo 0 |
| Atalho 404 anterior | Consulta individual 1/7; lint e processo 0 |
| 404 listagem | Código 2, antes do Docker |
| Cópia de diagnóstico com data em objeto | Teste 1/14 passou; lint e processo 1 |
| Cópia de diagnóstico sem meta | Teste 1/14 passou; lint e processo 1 |

Os diagnósticos em /tmp/curso-675 usam cópias do script com a raiz ajustada e
uma alteração apenas no example temporário: data recebe seu primeiro produto,
ou meta é removido. Não alteram schema, aplicação ou corpo bruto capturado.
O validador apontou respectivamente tipo array exigido e propriedade meta
obrigatória; nenhuma regra foi ignorada. Pastas temporárias do fluxo removidas
após sucesso e falhas. A última captura original mantém data lista, meta e
preço inteiro: ID observado 22914, 586 bytes, SHA256
cee3d4a19ffc8291017a547fbd64daf493b54a5d18f54d65e200ba0e5bdf2107.
O ID é gerado pela factory, sem valor fixado no teste.

A primeira execução de listagem preservou os hashes das capturas individuais.
Os comandos individuais de regressão depois renovaram suas próprias capturas.
SELECTs antes/depois: loja/loja_app 0 categorias/1 produto;
loja_test/loja_testes 0 categorias/0 produtos. Captura privada ignorada pelo Git;
diff e links locais conferidos. Backend, OpenAPI, configuração e atalho 404
inalterados; nenhuma dependência ou serviço novo. Sem nova suíte completa,
pois o backend não mudou: última suíte na 6.74, 66 testes/620 asserções.

## Continuidade

Aula anterior registra publicação da 6.74. Catálogo em português, roteiro e
progresso registram implementação, explicação e verificação da 6.75; entendimento
confirmado com "entendi" em 01/11/2026 e publicação verificada. O fluxo cobre um caso de listagem
200 e os casos individuais 200/404, sem substituir as asserções de negócio nem
provar todas as possíveis respostas. A limitação do validador observada na 6.64
continua registrada; id path original mantém required true.

Após confirmar entendimento e publicar, iniciar somente 6.76: preparar captura
optativa da resposta 422 da listagem em um caso de entrada inválida do teste HTTP.
Exercício DBeaver continua sem relato do aluno.

Continuidade realizada na [aula 06-76](06-76-captura-listagem-422.md):
captura optativa do caso page=0 da listagem.
