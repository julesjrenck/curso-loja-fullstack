# Aula 8.41 — Verificação dos módulos no navegador

Iniciada em 07/11/2026 após confirmação da [8.40](08-40-modulos-export-import.md)
com "entendi". Checkpoint anterior publicado e conferido em
3e719fc3849ebebe58a0167fc6eb407dd45a09b1; HEAD/origin/main/main remota iguais.
Esta etapa altera somente documentação; HTML, CSS e os dois JS permanecem como na 8.40.

## Objetivo e conceito

Verificar o carregamento de vitrine.js e sua dependência textos.js, relacionando
os pedidos HTTP com o funcionamento da busca. A aba Network mostra recursos
solicitados; o Console mostra mensagens e erros de execução. Receber um arquivo
não comprova, sozinho, que a função exportada foi usada corretamente; por isso
conferiremos também o comportamento do filtro.

## Network/Rede no Chrome

1. Abra a [vitrine](http://127.0.0.1:8001/vitrine.html), sem query ou fragmento
   no endereço inicial.
2. Abra DevTools com Ctrl+Shift+J e selecione a aba Network/Rede. Se a lista
   estiver vazia, ela poderá começar a registrar os recursos após o reload.
3. Com DevTools aberto, recarregue com Ctrl+Shift+R para solicitar a versão atual.
4. Na lista, localize vitrine.js e textos.js. Se necessário, use o filtro de
   tipo JS para reduzir a lista. Verifique a coluna Status: esperamos 200 para
   ambos nesse carregamento. Se aparecer outro status ou indicação de cache,
   informe exatamente o que apareceu para interpretarmos.
5. Clique em textos.js e abra Response/Resposta. O conteúdo esperado é:

```js
export const prepararTexto = (texto) => texto.trim().toLowerCase();
```

Em vitrine.js, a resposta deve começar com import de prepararTexto vindo de
'./textos.js'. A presença de textos.js no carregamento está ligada a essa
dependência, enquanto o script no HTML aponta para vitrine.js.

Atalhos descritos para Windows/Linux. Fontes primárias:
[Network do Chrome DevTools](https://developer.chrome.com/docs/devtools/network)
e [atalhos do DevTools](https://developer.chrome.com/docs/devtools/shortcuts).
O painel registra a rede enquanto DevTools está aberto; por isso abrimos antes
de recarregar. A resposta exibida é o código recebido, não uma chamada manual
da função no Console.

## Execução da busca

Volte à aba Console. Esperamos a mensagem JavaScript da vitrine carregado.
e os registros iniciais, sem erro de importação. No catálogo, os dois produtos
devem estar visíveis e a mensagem de nenhum resultado deve estar oculta.

Depois desse preparo, faça a sequência sem recarregar entre as buscas.
Substitua o conteúdo inteiro do campo a cada linha. Para Enter, mantenha o
foco no campo, não no Console.

| Campo | Ação | Total no Console | Cartões visíveis | Mensagem |
| --- | --- | --- | --- | --- |
| Dois espaços, CAMISETA, dois espaços | Buscar | 1 | Camiseta | Oculta |
| sapato | Enter no campo | 0 | Nenhum | Visível |
| Campo vazio | Buscar | 2 | Camiseta e Caneca | Oculta |

O log Busca enviada do primeiro envio deve usar camiseta em minúsculas,
demonstrando o preparo do termo. Os nomes registrados também devem estar
preparados; isso relaciona as duas chamadas à função importada. O log final
Produtos encontrados deve mostrar 1, 0 e 2, nessa ordem.

O endereço deve permanecer igual, sem navegação ou ?nome=. O último envio
deve restaurar os cartões e ocultar o aviso sem reload. Esses resultados
permitem verificar o módulo junto ao fluxo de busca que já conhecemos.

## Relação entre arquivos

[src/vitrine.html](../../src/vitrine.html) carrega
[src/vitrine.js](../../src/vitrine.js) com type module. Vitrine importa a
exportação nomeada de [src/textos.js](../../src/textos.js) e a chama para termo
e nomes. [src/vitrine.css](../../src/vitrine.css) mantém o layout.
Nenhum desses arquivos é alterado nesta etapa. A busca continua local, sem API
ou banco; os recursos observados na rede são arquivos da página.

## Relato e continuidade

Informe se os dois arquivos apareceram na Network, se o conteúdo de textos.js
correspondeu e se a busca coincidiu com a tabela. Se algo divergir, diga o
arquivo/status ou o passo, o resultado e eventual erro no Console. Um relato
geral de sucesso como "funcionou" basta quando todas as ações coincidirem;
será registrado como relato geral do aluno, sem inventar resultados individuais
ou observação direta do assistente.

Confirme também se o vínculo HTML → vitrine.js → textos.js ficou entendido.
"Entendi" sozinho confirma aprendizagem, não execução. Se ainda não executou,
a verificação ficará pendente. Investigar divergências antes de continuar.

Roteiro e explicação apresentados. Entendimento e sucesso geral confirmados com
"funcinou e entendi" em 07/11/2026, interpretado como "funcionou e entendi".
Sem resultados individuais transcritos ou observação direta do assistente.
Checkpoint concluído; publicação pendente conforme autorização permanente.
Próximo passo após conclusão/publicação: 8.42 — introdução a promises com
Promise.resolve e then. Não iniciada.
