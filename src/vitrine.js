console.log('JavaScript da vitrine carregado.');

const formularioBusca = document.querySelector('.busca');
const campoNome = formularioBusca.querySelector('#busca-nome');

console.log(formularioBusca);
console.log('Valor inicial da busca:', campoNome.value);

formularioBusca.addEventListener('submit', function (evento) {
    evento.preventDefault();

    const termoBusca = campoNome.value.trim().toLowerCase();

    console.log('Busca enviada:', termoBusca);
});
