console.log('JavaScript da vitrine carregado.');

const formularioBusca = document.querySelector('.busca');
const campoNome = formularioBusca.querySelector('#busca-nome');

console.log(formularioBusca);
console.log('Valor inicial da busca:', campoNome.value);

formularioBusca.addEventListener('submit', function (evento) {
    evento.preventDefault();

    console.log('Busca enviada:', campoNome.value);
});
