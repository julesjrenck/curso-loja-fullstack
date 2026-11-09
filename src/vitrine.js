import { prepararTexto } from './textos.js';

console.log('JavaScript da vitrine carregado.');

const produtoExemplo = {
    nome: 'Camiseta',
    preco: 4990,
};

console.log('Produto de exemplo:', produtoExemplo);
console.log('Nome do produto:', produtoExemplo.nome);
console.log('Preço em centavos:', produtoExemplo.preco);

const produtosExemplo = [
    produtoExemplo,
    {
        nome: 'Caneca',
        preco: 2990,
    },
];

console.log('Produtos de exemplo:', produtosExemplo);
console.log('Primeiro produto:', produtosExemplo[0].nome);
console.log('Segundo produto:', produtosExemplo[1].nome);
console.log('Quantidade de produtos:', produtosExemplo.length);

produtosExemplo.forEach((produto) => {
    console.log('Produto da lista:', produto.nome, produto.preco);
});

const produtosJson = JSON.stringify(produtosExemplo);

console.log('Produtos em JSON:', produtosJson);

const produtosLidos = JSON.parse(produtosJson);

console.log('Produtos lidos do JSON:', produtosLidos);
console.log('Primeiro produto lido:', produtosLidos[0].nome);

const formularioBusca = document.querySelector('.busca');
const campoNome = formularioBusca.querySelector('#busca-nome');
const produtos = document.querySelectorAll('.produto');
const mensagemSemResultados = document.querySelector('#sem-resultados');

console.log(formularioBusca);
console.log('Valor inicial da busca:', campoNome.value);
console.log(produtos);
console.log(mensagemSemResultados);

function tratarBusca(evento) {
    evento.preventDefault();

    const termoBusca = prepararTexto(campoNome.value);
    let quantidadeResultados = 0;

    console.log('Busca enviada:', termoBusca);

    produtos.forEach((produto) => {
        const nomeProduto = prepararTexto(produto.querySelector('h2').textContent);
        const corresponde = nomeProduto.includes(termoBusca);

        produto.hidden = !corresponde;

        if (corresponde) {
            quantidadeResultados += 1;
        }

        console.log(nomeProduto, corresponde);
    });

    mensagemSemResultados.hidden = quantidadeResultados > 0;

    console.log('Produtos encontrados:', quantidadeResultados);
}

formularioBusca.addEventListener('submit', tratarBusca);

async function prepararMensagem() {
    try {
        const mensagem = await Promise.resolve('Vitrine pronta para a busca.');

        return mensagem;
    } catch (motivo) {
        console.error('Falha tratada dentro da função:', motivo);

        return 'Mensagem alternativa da vitrine.';
    }
}

async function formatarMensagem() {
    const mensagem = await prepararMensagem();

    return mensagem.toUpperCase();
}

async function exibirMensagem() {
    try {
        const mensagemFormatada = await formatarMensagem();

        console.log(mensagemFormatada);
    } catch (motivo) {
        console.error('Não foi possível preparar a mensagem:', motivo);
    } finally {
        console.log('Preparação da mensagem encerrada.');
    }
}

console.log('Antes de chamar exibirMensagem.');

exibirMensagem();

console.log('Depois de chamar exibirMensagem.');

async function carregarProdutos() {
    try {
        const resposta = await fetch('./produtos.json');

        console.log('Resposta dos produtos:', resposta);
        console.log('Status HTTP dos produtos:', resposta.status);
    } catch (motivo) {
        console.error('Falha ao buscar produtos:', motivo);
    }
}

carregarProdutos();
