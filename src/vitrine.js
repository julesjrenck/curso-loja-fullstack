import { prepararTexto } from './textos.js';

console.log('JavaScript da vitrine carregado.');

const produtoExemplo = {
    nome: 'Camiseta',
    preco: 4990,
};

console.log('Produto de exemplo:', produtoExemplo);
console.log('Nome do produto:', produtoExemplo.nome);
console.log('Preço em centavos:', produtoExemplo.preco);

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
