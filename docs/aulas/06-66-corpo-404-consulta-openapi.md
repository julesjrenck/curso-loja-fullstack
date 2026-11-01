# Aula 6.66 — Corpo 404 da consulta individual no OpenAPI

Implementação, explicação e verificação em 01/11/2026 após confirmação da
6.65 com "entendi" e publicação em 087430c1f2c1c8fe943a95f6fd0239fa527d16cf.
Entendimento da 6.66 confirmado com "entendi" em 01/11/2026; publicação
verificada em a9e7c41fb4fc0a24c8b461e5f891c8773058c2b5, referências local e remotas coincidentes.

## Um campo obrigatório de texto

Em [openapi.json](../api/openapi.json), a resposta 404 de
GET /api/v1/produtos/{id} recebeu content/application/json. Seu schema:

```json
{
  "type": "object",
  "required": [
    "message"
  ],
  "properties": {
    "message": {
      "type": "string",
      "description": "Descrição do erro. Produto inexistente, inativo ou ID fora da faixa de inteiros recebem 'Produto não encontrado.'. Nos erros de roteamento, o texto pode variar."
    }
  }
}
```

Type object descreve o corpo externo. Required exige a presença de message.
Properties.message.type string exige texto nesse campo. O status 404 pertence
à resposta HTTP, enquanto message descreve o erro no corpo JSON.

O controller retorna este corpo para produto inexistente, inativo ou ID acima
da faixa de inteiros aceita pelo backend:

```json
{"message": "Produto não encontrado."}
```

Um ID malformado, como abc ou 01, pode ser rejeitado pelo roteamento antes de
chegar ao controller. O bootstrap configura JSON para api/*, e o texto desses
erros pode variar. Por isso, o schema exige string sem const ou enum que fixe
uma frase. A descrição registra o comportamento de cada origem do erro.
Propriedades adicionais permanecem permitidas, como nos schemas anteriores.

Conferimos por leitura ProdutoController::show, bootstrap/app.php e os testes
existentes de inexistente/inativo/ID malformado/acima da faixa. Nenhum arquivo
de produção foi alterado. Os corpos 200 individual e da listagem foram preservados.

## Verificação executada

Mesma imagem e [redocly.yaml](../api/redocly.yaml) das etapas anteriores.
Executado na raiz do repositório:

```sh
docker run --rm --network none \
  --volume "$PWD/docs/api:/spec:ro" \
  --workdir /spec \
  redocly/cli:2.65.0@sha256:42acee0d7e629a9d0376d8df579dc325e51da727de06a31036bccc02409a7e11 \
  lint openapi.json --config redocly.yaml
```

O container é removido ao terminar (--rm), executa sem rede (--network none)
e lê docs/api em /spec somente para leitura. Workdir define a pasta de execução;
lint recebe documento e configuração. Resultado: código 0, sem erros ou avisos.

Quatro cópias em /tmp/curso-666 receberam example somente temporário em 404.
A pasta foi montada em /casos somente para leitura, usando a mesma imagem e
configuração com cada cópia como entrada:

| Corpo na cópia | Resultado observado |
| --- | --- |
| Message Produto não encontrado. | Código 0 |
| Message Mensagem ilustrativa de erro de rota. | Código 0 |
| Message como número 404 | Código 1: tipo string exigido |
| Objeto sem message | Código 1: propriedade obrigatória |

A segunda frase é apenas ilustrativa, não uma captura do texto real do
framework. As duas rejeições vieram de no-invalid-media-type-examples, com
um erro por execução. Nenhuma regra foi ignorada. Cópias fora do Git; documento
do projeto preservado após diagnósticos, sem exemplo permanente nessa operação.

Diff e links locais conferidos. A limitação observada na 6.64 permanece
registrada; id path continua required true no arquivo do projeto. Sem novas
dependências, captura HTTP, SQL ou nova suíte Laravel; última suíte na 6.49:
66 testes e 620 asserções. Validar exemplos não comprova respostas reais.

## Continuidade

Contrato em português, roteiro e progresso atualizados. Entendimento confirmado
com "entendi" em 01/11/2026; publicação verificada em a9e7c41fb4fc0a24c8b461e5f891c8773058c2b5.
Continuidade na [aula 06-67](06-67-exemplo-200-consulta-openapi.md).
