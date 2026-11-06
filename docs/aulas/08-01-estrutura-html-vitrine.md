# Aula 8.1 — Estrutura HTML da vitrine

Retomada em 06/11/2026, a pedido do aluno, após o encerramento confirmado do
módulo 7 na [revisão 7.89](07-89-revisao-autenticacao-autorizacao.md).
Módulos 1 a 7 concluídos. Esta é a primeira pequena etapa do módulo 8.

## Objetivo e conceito

Criar o documento inicial da vitrine, identificando o cabeçalho, o conteúdo
principal e o rodapé. HTML é uma linguagem de marcação: os elementos descrevem
o conteúdo e seu significado. CSS cuidará da apresentação; JavaScript será
introduzido para o comportamento e o consumo da API em etapas posteriores.

No PHP já vimos o servidor produzir HTML pela view Blade. Aqui o servidor
entrega um arquivo HTML estático ao navegador, que interpreta sua marcação.
Não há execução de PHP ou Blade dentro deste arquivo.

## Arquivo criado

[src/vitrine.html](../../src/vitrine.html) contém toda a implementação desta
etapa. Foi usado o laboratório existente, sem adicionar containers ou pacotes.

```html
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vitrine | Loja Fullstack</title>
</head>
<body>
    <header>
        <p>Loja Fullstack</p>
    </header>

    <main>
        <h1>Catálogo de produtos</h1>
        <p>Conheça os produtos da nossa loja.</p>
    </main>

    <footer>
        <p>Loja Fullstack</p>
    </footer>
</body>
</html>
```

## Como ler a marcação

`<p>Loja Fullstack</p>` tem uma tag de abertura, o texto e uma tag de
fechamento. O conjunto forma um elemento de parágrafo. A indentação mostra
quais elementos estão dentro de outros; não é ela que define essa relação.

| Trecho | Função |
| --- | --- |
| `<!doctype html>` | Solicita o modo padrão de interpretação do HTML nos navegadores atuais; não é uma tag de conteúdo |
| `<html lang="pt-BR">` | Elemento raiz; o atributo `lang` informa português do Brasil, útil também para leitores de tela |
| `<head>` | Reúne os metadados do documento |
| `<meta charset="utf-8">` | Declara a codificação dos caracteres, incluindo os acentos |
| `<meta name="viewport" content="width=device-width, initial-scale=1">` | Orienta a área de visualização em dispositivos móveis; o layout responsivo será trabalhado depois |
| `<title>` | Define o título do documento, normalmente mostrado na aba do navegador |
| `<body>` | Contém o conteúdo apresentado na página |
| `<header>` | Agrupa a apresentação da loja no início do documento |
| `<main>` | Identifica o conteúdo principal desta página; usamos apenas um |
| `<h1>` | Título principal do conteúdo: Catálogo de produtos |
| `<p>` | Marca um parágrafo |
| `<footer>` | Agrupa o conteúdo de rodapé |

`head` e `header` têm funções diferentes: o primeiro contém metadados; o
segundo participa do conteúdo da página. Da mesma forma, `title` aparece na
aba e `h1` aparece no conteúdo. A hierarquia dos títulos representa organização,
não uma escolha de tamanho de fonte.

`meta` é um elemento vazio: não recebe conteúdo interno nem tag `</meta>`.
Os demais elementos usados aqui têm fechamento explícito.

Usar `header`, `main` e `footer` dá significado às regiões, inclusive para
tecnologias assistivas. Isso não aplica cores ou posicionamento automaticamente,
nem constitui uma auditoria completa de acessibilidade. A aparência inicial
vem dos estilos padrão do navegador.

Referências primárias: [metadados e estrutura do documento no HTML Standard](https://html.spec.whatwg.org/multipage/semantics.html),
[cabeçalhos, títulos e rodapés](https://html.spec.whatwg.org/multipage/sections.html)
e [elemento main](https://html.spec.whatwg.org/multipage/grouping-content.html#the-main-element).

## Relação com o Docker e verificação

O [compose.yaml](../../compose.yaml) já monta `./src` em `/app` no serviço
`php`. O servidor configurado por `php -S 0.0.0.0:8000 -t /app` usa `/app`
como raiz dos documentos. A porta 8000 do container é publicada em 8001 no host.

Na raiz do repositório:

```sh
docker compose up -d php
```

`up` prepara e inicia o serviço; `-d` o mantém em segundo plano; `php` seleciona
somente o laboratório. Se a imagem local ainda não existir, Compose a constrói
pelo Dockerfile existente. Nenhuma alteração do Compose é necessária para
adicionar este HTML: a montagem já disponibiliza o arquivo.

Abra [http://127.0.0.1:8001/vitrine.html](http://127.0.0.1:8001/vitrine.html).
A entrada é um GET para esse caminho; a saída esperada é HTTP 200 com HTML.
O título da aba deve ser “Vitrine | Loja Fullstack”; no conteúdo devem aparecer
o nome da loja, “Catálogo de produtos”, a apresentação e o rodapé.

A verificação do assistente recebeu HTTP 200, Content-Type text/html com
charset UTF-8 e corpo idêntico ao arquivo local, comparado com `cmp` (código 0).
O `up` construiu a imagem existente, mas não conseguiu iniciar o container
porque a porta 8001 já estava ocupada. Uma consulta HTTP fora do sandbox
confirmou que essa porta já entregava o arquivo desta aula. O processo que
atende essa porta não foi identificado; não atribuímos a resposta ao container
que falhou. Esse container em estado Created foi removido, sem remover volumes
ou interromper o serviço que já atendia a página.

Detalhes no [progresso](../progresso.md). Conferir resposta/corpo não equivale
a observar a renderização no navegador do aluno. Não foi criada integração com
a API nesta etapa: os textos vêm do próprio arquivo, sem consulta ao banco.

## Pausa pedagógica

Implementação e explicação da 8.1 apresentadas; entendimento confirmado pelo
aluno com "entendi" em 06/11/2026. Nenhuma dúvida nova relatada. A confirmação
não inclui um relato separado de execução no navegador. Checkpoint local
cdb03955b421c4dbc56ccd8e7d416e9adda87d53. A primeira tentativa de push foi
rejeitada pela revisão automática por exigir autorização explícita. O aluno
autorizou "Sim, publicar os checkpoints concluídos" em 06/11/2026. Após essa
autorização, push concluído e HEAD/origin/main/main remota conferidos no SHA
acima. Registro posterior à publicação, destinado ao checkpoint seguinte.

Após confirmação e checkpoint local, continuidade iniciada na
[8.2](08-02-primeiro-produto-html.md), primeiro produto demonstrativo no catálogo
e hierarquia dos títulos. Entendimento da 8.2 ainda aguardando confirmação.
