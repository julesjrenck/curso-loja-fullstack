# Aula 6.79 — Documentar a execução das verificações

Implementação, explicação e verificação documental em 01/11/2026 após
confirmação da 6.78 com "entendi" e publicação em 592a00a5d5993b7f59b932683d871c3ac860358f.
Entendimento da 6.79 confirmado com "entendi" em 01/11/2026; publicação
verificada em cbe8ae9e8250b4903767f4dc6ef5b7c9cb9b765c, referências local e remotas coincidentes.

## Objetivo e arquivo alterado

Acrescentamos ao [README](../../README.md#verificar-o-backend-e-os-contratos-da-api)
a seção Verificar o backend e os contratos da API e um link no índice Documentação.
Ela permite localizar os pré-requisitos e executar as verificações já estudadas.
Nesta etapa, a alteração funcional é apenas documental: backend e scripts
continuam como estavam.

## Pré-requisitos apresentados

A seção informa Docker/Compose disponíveis, backend/sqlserver iniciados e banco
pronto; dependências de desenvolvimento instaladas pelo lockfile e descoberta
de pacotes concluída. Os links apontam para as instruções existentes.

Para testes de integração, informa .env.testing local com chave própria e acesso
a loja_test pela conta loja_testes. O modelo público continua sem valores reais.
Links levam à preparação da conta, ambiente, produtos, categorias e chave
estrangeira. São requisitos do ambiente já construído; não executamos instalação,
geramos credenciais ou aplicamos migrations nesta etapa.

## Dois comandos e o que demonstram

Na raiz do repositório, para os comportamentos de backend/tests:

```sh
docker compose exec -T backend php artisan test --do-not-cache-result
```

Exec usa o backend existente; -T dispensa terminal interativo. A opção
--do-not-cache-result evita escrever cache de resultados em /app somente leitura.
Phpunit.xml define APP_ENV=testing e DB_DATABASE=loja_test. Os testes de
integração conferem também a conta e usam transações para desfazer os dados.

Para os quatro casos de contrato:

```sh
bash scripts/validar-contratos-catalogo.sh
```

O script roda os testes focados, gera capturas atuais e compara seus corpos aos
schemas OpenAPI numa cópia temporária: consulta 200/404 e listagem 200/422.
A sequência para no primeiro erro; a mensagem final indica sucesso dos quatro.
O README explica capturas privadas ignoradas e remoção dos temporários.
A suíte cobre comportamentos; o comando de contratos compara os corpos desses
casos aos schemas. As verificações se complementam.

A preparação da imagem Redocly fica explícita em um terceiro bloco:
docker pull com a mesma versão 2.65.0 e o digest já fixado no script comum.
O download ocorre antes; a execução do validador usa --network none. PHP,
Composer, testes e Redocly permanecem em Docker; Bash no host coordena.

## Verificação documental

Conferimos os três blocos de comando exatamente, caminho do script existente,
quatro pares no script conjunto, versão/digest no script comum e configuração
testing/loja_test/loja_testes no phpunit.xml/modelo público. Os 108 links locais
do README apontam para arquivos existentes; âncoras novas conferidas pelos títulos.
Diff e links dos demais documentos conferidos. Nenhum arquivo local privado
foi incluído. Backend/scripts/OpenAPI/configuração/Compose/dependências intactos.

Não houve nova execução de Docker, PHP, testes, Redocly ou SELECTs nesta etapa
documental. Última suíte completa: 6.76, 66 testes/620 asserções. Último comando
conjunto real: 6.78, quatro casos e quatro validações aprovados, processo 0.
Os resultados históricos permanecem identificados como tais.

## Continuidade

A aula anterior registra publicação da 6.78. Catálogo, roteiro e progresso
registram implementação, explicação e verificação da 6.79; entendimento confirmado
com "entendi" em 01/11/2026 e publicação verificada. Depois de publicar, iniciar
somente 6.80: revisão guiada de GET /api/v1/produtos?page=0, relacionando validação,
resposta 422, teste e contrato. Módulo 6 continua em andamento; DBeaver sem relato.

Continuidade realizada na [aula 06-80](06-80-revisao-requisicao-invalida.md):
revisão guiada do caminho de page=0 até teste e contrato.
