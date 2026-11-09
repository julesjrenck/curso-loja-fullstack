# Aula 8.66 — Arquivo JSON local de produtos

Iniciada em 07/11/2026 após confirmação da 8.65 com "entendi". Atividade
opcional anterior no navegador sem relato. Checkpoint anterior publicado em
018905e57e3129e89e030facd21e5072eb0017fe; HEAD/origin/main/main remota iguais.

## Objetivo e arquivo criado

Disponibilizar os dados de demonstração em um recurso HTTP próprio para o
primeiro fetch da próxima etapa. Criamos [src/produtos.json](../../src/produtos.json):

```json
[
    {
        "nome": "Camiseta",
        "preco": 4990
    },
    {
        "nome": "Caneca",
        "preco": 2990
    }
]
```

O arquivo contém texto JSON: uma lista com dois objetos. Os nomes das
propriedades e os valores string usam aspas duplas; os preços são números
inteiros em centavos. A vírgula separa as propriedades de cada objeto e os
dois objetos na lista. Não há vírgula depois da última propriedade ou do
último elemento. A indentação e as quebras de linha ajudam a leitura.

Não escrevemos const, nome de variável, chamada de função ou ponto e vírgula:
o conteúdo inteiro é o dado JSON que um leitor poderá interpretar. Ele
representa os mesmos produtos usados nos exemplos de stringify e parse.

## Caminho no disco e URL

O serviço PHP do projeto foi configurado para servir src como raiz da página,
montada em /app no container. Usamos o servidor já acessível na porta 8001.
Assim, o arquivo src/produtos.json fica disponível por:

http://localhost:8001/produtos.json

Um GET nessa URL pede o recurso ao servidor. Esperamos HTTP 200, tipo
application/json e o corpo do arquivo. Esse é um recurso estático de
demonstração: o servidor entrega o conteúdo do arquivo. O catálogo Laravel
e suas rotas de negócio continuam no backend já existente.

[vitrine.html](../../src/vitrine.html) e produtos.json ficam na mesma origem
local, com mesmo protocolo, host e porta quando abertos pelas URLs acima.
Isso permitirá começar fetch usando um caminho relativo para o arquivo.
Ainda não acrescentamos essa chamada ao [vitrine.js](../../src/vitrine.js).

## Relação com os arquivos anteriores

vitrine.js continua com os dados locais, stringify, parse, filtro dos cartões
e funções async. O novo arquivo não passa a ser carregado automaticamente
pela página: sua leitura será introduzida na próxima etapa.
O import de [textos.js](../../src/textos.js), o HTML e
[vitrine.css](../../src/vitrine.css) foram preservados.

Os valores são dados fictícios de demonstração: Camiseta/4990 e Caneca/2990.
Não mudamos banco, API Laravel, dependências ou serviços permanentes.

## Verificação e comandos

Validamos o texto com json_decode e JSON_THROW_ON_ERROR em um container
temporário da imagem PHP já disponível, lendo src em /app com montagem somente
leitura. O comando docker run usou --rm para remover o container ao terminar,
--pull=never para usar a imagem local e --network none porque essa validação
não precisa de rede. php -r executou a leitura/decodificação do arquivo,
contou os produtos e exibiu nomes/preços para conferência. PHP executado em Docker.

Também fizemos GET /produtos.json com curl, conferindo status, Content-Type e
igualdade do corpo com o arquivo local por cmp. Isso demonstra entrega do recurso
e, junto à decodificação, validade/conteúdo dos dados. Não demonstra fetch ou
JSON.parse executados pelo navegador.

Resultados: PHP 8.4.26 decodificou JSON válido com 2 produtos, Camiseta/4990 e
Caneca/2990, código 0. HTTP 200, Content-Type application/json, 127 bytes; corpo
igual ao arquivo local. git diff --check passou; HTML/CSS/vitrine.js/textos.js
preservados por diff. Links locais conferidos. Nenhuma imagem nova ou serviço
permanente iniciado para a validação.

Atividade opcional: abra http://localhost:8001/produtos.json em outra aba e
confira os dois objetos, Camiseta/4990 e Caneca/2990. O navegador pode apresentar
JSON com cores, indentação ou recursos de expansão; compare os dados. Volte à
vitrine e recarregue se quiser conferir o comportamento já conhecido. Informe
qualquer diferença ou erro. Resultado no navegador ainda sem relato ou observação
direta do assistente.

## Estado e continuidade

Arquivo criado e explicação apresentada; entendimento confirmado com "entendi"
em 07/11/2026. Verificações realizadas e registradas no progresso. Atividade
opcional no navegador sem relato ou observação direta.
Checkpoint publicado e conferido em a1225c3f2f554a9e8ebf554dc143a52a43530db9;
HEAD/origin/main/main remota iguais. Registro posterior à publicação.
Continuidade na [8.67 — primeiro fetch do arquivo JSON](08-67-primeiro-fetch-json.md).
