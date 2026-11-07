console.log('JavaScript da vitrine carregado.');

const formularioBusca = document.querySelector('.busca');
const campoNome = formularioBusca.querySelector('#busca-nome');
const produtos = document.querySelectorAll('.produto');
const mensagemSemResultados = document.querySelector('#sem-resultados');

console.log(formularioBusca);
console.log('Valor inicial da busca:', campoNome.value);
console.log(produtos);
console.log(mensagemSemResultados);

formularioBusca.addEventListener('submit', function (evento) {
    evento.preventDefault();

    const termoBusca = campoNome.value.trim().toLowerCase();

    console.log('Busca enviada:', termoBusca);

    produtos.forEach(function (produto) {
        const nomeProduto = produto.querySelector('h2').textContent.trim().toLowerCase();
        const corresponde = nomeProduto.includes(termoBusca);

        produto.hidden = !corresponde;

        console.log(nomeProduto, corresponde);
    });
});
