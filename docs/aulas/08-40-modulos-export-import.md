# Aula 8.40 — Módulos com export/import de prepararTexto

Iniciada em 07/11/2026 após confirmação da [8.39](08-39-verificacao-funcoes-busca.md)
com "funcionou e entendi", incluindo relato geral de sucesso no navegador.
Checkpoint anterior publicado e conferido em
476a283dc156665363a6d29fa6f2d838f04f6402; HEAD/origin/main/main remota iguais.

## Objetivo e conceito

Organizar o preparo dos textos em um módulo próprio e declarar sua relação
com a vitrine. Um módulo JavaScript pode exportar valores, como funções, para
outros módulos importarem. As variáveis não precisam ser colocadas no escopo
global da página para serem compartilhadas dessa forma.

## Arquivo criado: src/textos.js

```js
export const prepararTexto = (texto) => texto.trim().toLowerCase();
```

A função é a mesma arrow com parâmetro e retorno implícito da 8.38. Export
disponibiliza o nome prepararTexto para importação por outros módulos. Essa
forma é uma exportação nomeada: o nome faz parte da relação entre os arquivos.
O módulo recebe strings e devolve strings preparadas, sem acessar elementos
do DOM, formulário ou catálogo.

Exportar a função não chama seu corpo. O código que a importar poderá chamá-la
com os argumentos desejados. Seu cálculo continua removendo espaços nas
extremidades e convertendo letras para minúsculas.

## Alteração em src/vitrine.js

Acrescentado no início do arquivo:

```js
import { prepararTexto } from './textos.js';
```

Import declara a dependência. Entre as chaves, pedimos a exportação nomeada
prepararTexto; from indica o módulo de origem. O nome importado corresponde
exatamente ao nome exportado, incluindo maiúsculas e minúsculas.
Essas chaves são a sintaxe da lista de importações nomeadas.

A string './textos.js' é o endereço relativo ao módulo importador, vitrine.js.
O ./ indica a mesma pasta; a extensão .js identifica o arquivo servido pelo
navegador. Nesta organização, ele corresponde a /textos.js no servidor local.
Não é um endereço de API nem um pacote instalado.

A declaração local anterior de prepararTexto foi removida de vitrine.js.
Agora o nome fica disponível nesse módulo pela importação. As chamadas existentes
continuam iguais:

```js
const termoBusca = prepararTexto(campoNome.value);
```

```js
const nomeProduto = prepararTexto(produto.querySelector('h2').textContent);
```

Vitrine cuida do formulário/DOM, enquanto textos fornece o preparo das strings.
A importação ocorre no nível do módulo, fora das funções. Ela declara uma
dependência do arquivo; os parênteses nas chamadas acima continuam responsáveis
por executar a função e obter seu retorno durante cada busca.

Referências primárias: [módulos — ECMAScript](https://tc39.es/ecma262/multipage/ecmascript-language-scripts-and-modules.html#sec-modules)
e [resolução de caminhos de módulos — HTML Standard](https://html.spec.whatwg.org/multipage/webappapis.html#resolve-a-module-specifier).

## Relação com o HTML e carregamento

[src/vitrine.html](../../src/vitrine.html) já contém:

```html
<script type="module" src="vitrine.js"></script>
```

Type module permite o uso dessa sintaxe de import/export. O navegador solicita
vitrine.js, identifica a dependência e carrega textos.js. Nesse conjunto sem
ciclos, o módulo de textos é avaliado antes do código da vitrine que o utiliza.
A inclusão no HTML continua apontando para vitrine.js; textos.js é alcançado
pela importação, sem outro elemento script.

```text
vitrine.html → script module → vitrine.js
                              └── import → textos.js → export prepararTexto
```

São dois arquivos da aplicação como conjunto inseparável: criação de
[src/textos.js](../../src/textos.js) e atualização de
[src/vitrine.js](../../src/vitrine.js). O HTML e o
[CSS](../../src/vitrine.css) permanecem iguais. Os arquivos são entregues pelo
servidor local já usado; nenhum pacote, ferramenta ou serviço novo é necessário.

## Verificação e atividade acompanhada

Conferir exportação/importação com mesmo nome, caminho e extensão, remoção da
declaração duplicada e preservação das chamadas. Conferir entrega HTTP de ambos
os JS, tipo JavaScript e igualdade das respostas com os arquivos locais.
Resultados no [progresso](../progresso.md). Entrega dos arquivos não demonstra
resolução/execução dos módulos no navegador.

Atividade opcional: recarregar a [vitrine](http://127.0.0.1:8001/vitrine.html)
com Console aberto e enviar CAMISETA com espaços, sapato e vazio, sem reload
entre buscas. Esperam-se totais 1/0/2 e mensagem oculta/visível/oculta. Se houver
erro de carregamento/importação, seu texto permitirá investigar o vínculo.
Nenhuma execução desta alteração foi observada ou relatada nesta etapa.

## Continuidade

Implementação e explicação apresentadas; entendimento da 8.40 confirmado com
"entendi" em 07/11/2026. Nenhuma dúvida nova ou relato separado da atividade
opcional no navegador. Checkpoint publicado e conferido em
3e719fc3849ebebe58a0167fc6eb407dd45a09b1; HEAD/origin/main/main remota iguais.
Registro posterior à publicação. Continuidade na
[8.41](08-41-verificacao-modulos.md): verificação dos módulos no navegador.
