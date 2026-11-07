import { prepararTexto } from './textos.js';

console.log('JavaScript da vitrine carregado.');

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
