# Aula 6.50 — Introdução e desenho do OpenAPI do catálogo

Desenho, explicação e verificação por inspeção em 01/11/2026 após confirmação
da 6.49 com "entendi" e publicação em ddfbada9fa5aeb9c05f18698f28ecd2e3b1a51ca.
HEAD, origin/main e main remota conferidos após push. Entendimento da 6.50
confirmado com "entendi" em 01/11/2026; publicação verificada em
697f841ff891660d9bd980ade2aceb1d63a869e7, com referências local e remotas coincidentes.

## O que vamos descrever

O contrato em [catalogo.md](../api/catalogo.md) explica a API em português e
mostra exemplos. OpenAPI permite organizar a descrição de uma API HTTP em
dados que ferramentas conseguem interpretar. Isso pode alimentar documentação
visual, geração de clientes e verificações, conforme as ferramentas utilizadas.
A [introdução oficial](https://learn.openapis.org/introduction.html) explica
esse papel do formato.

Para a loja, essa descrição permitirá ao futuro frontend consultar como pedir
a lista de produtos e qual resposta esperar. Os testes existentes continuam
verificando o comportamento executado pelo Laravel. Escrever a descrição não
altera rotas ou regras, nem comprova por si só que a implementação está de acordo.

## Decisões desta etapa

- Versão planejada do formato: OpenAPI 3.2.1, identificada na
  [especificação oficial](https://spec.openapis.org/oas/v3.2.1.html).
- Formato escolhido para o projeto: JSON, que o aluno já utiliza. A
  especificação também admite YAML.
- Arquivo planejado: docs/api/openapi.json, a criar gradualmente após confirmação.
- Primeiro endpoint descrito: GET /api/v1/produtos, público e sem corpo de entrada.
- Servidor local ilustrativo: http://127.0.0.1:8002. O caminho terá /api/v1,
  evitando repetir esse prefixo na base do servidor.
- Título planejado: API de catálogo da loja. Revisão inicial do documento:
  info.version igual a 0.1.0, indicando o início dessa descrição parcial.

Não instalamos bibliotecas ou interfaces visuais nesta etapa. Não foi criado
arquivo OpenAPI; esta aula registra o desenho e a relação com o código existente.

## Organização planejada

| Campo | Responsabilidade no documento |
| --- | --- |
| openapi | Versão do formato, planejada como 3.2.1 |
| info | Identificação e revisão do documento |
| servers | Base da URL para acessar a API |
| paths | Caminhos e operações HTTP |
| parameters, dentro de get | Entradas page e nome na query |
| responses, dentro de get | Respostas 200 e 422 da listagem |
| components.schemas | Formatos reutilizáveis dos dados, introduzidos quando necessários |

É um mapa de responsabilidades, não um documento OpenAPI pronto.
Na especificação, openapi e info.version têm funções distintas. O v1 de
/api/v1 também é outra informação: identifica a versão de negócio na URL.
Nenhum desses números precisa ser igual aos demais.

## Escopo da listagem, baseado na aplicação atual

| Parte | Comportamento a descrever gradualmente |
| --- | --- |
| Método/caminho | GET /api/v1/produtos |
| page | Opcional; padrão 1; decimal positivo sem sinal/zeros iniciais, até 1000000 |
| nome | Opcional; presente deve ter 1–100 caracteres após normalização |
| Busca | Trecho literal, somente ativos, comparação de caixa/acentos já estudada |
| Resposta 200 | application/json com data, links e meta |
| Produto em data | id, nome e preco_em_centavos |
| Paginação | Até dez itens, total filtrado e nome preservado nos links |
| Sem resultados/página após a última | Continua 200 com data vazia e metadados correspondentes |
| Resposta 422 | application/json com message e errors.page e/ou errors.nome |

O desenho deve preservar detalhes que já testamos, como remoção de espaços
externos, string '0' válida e posições null em página vazia. Alguns comportamentos
precisam também de descrição textual e testes; declarar tipos não representa
automaticamente toda a normalização e comparação executadas pela aplicação.

O GET individual por ID terá sua descrição em outra etapa. Seus 200/404 já
existem, mas não são respostas da operação de listagem que estamos desenhando.

## Verificações e próximo passo

Conferidos routes/api.php e bootstrap/app.php para método/prefixo; o Form
Request para entradas; controller/serviço para filtro e paginação; resource,
contrato e testes para campos e respostas. O desenho corresponde ao comportamento
atual da listagem. Git diff --check e links locais da documentação conferidos.

A etapa altera somente documentação. Não executamos novamente testes PHP,
consultas ou validação OpenAPI. A última suíte executada foi a da 6.49:
66 testes/620 asserções passaram. Ainda não existe documento para validar.

Entendimento confirmado com "entendi" em 01/11/2026; publicação verificada em
697f841ff891660d9bd980ade2aceb1d63a869e7. Continuidade na
[aula 06-51](06-51-esqueleto-openapi.md).
