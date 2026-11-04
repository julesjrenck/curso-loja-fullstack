# Aula 7.9 — Proteção CSRF no fluxo por sessão e cookie

Apresentada e verificada em 03/11/2026, após confirmação da 7.8 com "entendi".
Checkpoint anterior publicado e conferido em
c5008fd56cd102cc5d24ce295d29a25a5f068f6e; HEAD/origin/main/main remota iguais
após push. Entendimento da 7.9 confirmado com "entendi" em 03/11/2026.

## Objetivo e problema

CSRF significa Cross-Site Request Forgery: uma tentativa de fazer o navegador
enviar uma operação indesejada para outro site. Exemplo ilustrativo: Ana está
autenticada na loja e outra página tenta enviar uma alteração de endereço.
Se os cookies forem enviados conforme as regras do navegador, a requisição
pode chegar à loja com a sessão de Ana, mesmo sem ela ter feito a operação
pela interface da loja. A proteção precisa considerar essa procedência.

| Conceito | Responsabilidade |
| --- | --- |
| Autenticação | Identificar o usuário |
| Autorização | Decidir se ele pode executar uma ação |
| Proteção CSRF | Verificar a procedência da requisição no fluxo que usa cookies |

Não implementamos uma rota de alteração de endereço ou um ataque real.
O exemplo apresenta o problema que motiva a proteção.

## Comportamento instalado no Laravel 13

O middleware PreventRequestForgery já está no grupo web, conforme a 7.8.
Conferimos somente seus trechos relevantes no framework instalado, sem alterar
dependências. Sua verificação de origem aceita Sec-Fetch-Site: same-origin.
Quando esse caminho não passa, usa a comparação do token recebido com o token
da sessão. Leituras GET/HEAD/OPTIONS passam sem essa comparação; não usamos
GET para executar alterações de dados.

Portanto, não seria correto afirmar que todo POST sem token resulta em 419.
O caso same-origin e o caminho de token são alternativas na configuração atual.
O cabeçalho de origem da demonstração foi construído pelo diagnóstico: não
testamos o comportamento de um navegador nem suas regras de envio de cookies.

## Valores com responsabilidades diferentes

| Valor | Função no contexto estudado |
| --- | --- |
| Cookie de sessão | Referenciar a sessão entre requisições |
| Token CSRF | Valor ligado à sessão, comparado ao recebido no pedido quando a validação por token é necessária |
| remember_token do User | Campo do mecanismo de lembrar autenticação; não é o token CSRF |

No caminho por token, o servidor precisa receber o valor no pedido, além do
cookie de sessão. Em formulário Blade, @csrf gera um campo oculto _token.
Em requisições de JavaScript, X-CSRF-TOKEN é uma das formas de fornecer o valor.
São exemplos conceituais; não adicionamos formulário ou frontend nesta aula.
O fluxo de SPA/Sanctum e X-XSRF-TOKEN será tratado quando utilizado.

Somente a presença do cookie não satisfaz a comparação de tokens. HttpOnly
restringe acesso do JavaScript ao cookie de sessão, mas o navegador continua
podendo enviá-lo: essa opção não substitui a verificação CSRF.

Referência: [proteção CSRF no Laravel 13](https://laravel.com/docs/13.x/csrf).

## Demonstração em memória

Executamos um diagnóstico por stdin a docker compose exec -T backend php.
Ele carregou a aplicação e o kernel HTTP sem iniciar atendimento de rede.
Confirmou que não estava no modo de testes: o middleware normalmente dispensa
essa proteção quando o Laravel executa testes, por isso a suíte comum não
seria evidência suficiente deste comportamento.

Para cada caso, criamos Request e uma sessão Store com ArraySessionHandler.
A sessão foi iniciada somente em memória. Chamamos diretamente handle do
middleware, passando uma função que retorna resposta 200 e marca se foi chamada.
Em TokenMismatchException, o handler de exceções do Laravel produziu a resposta
419. A URL ilustrativa não foi registrada como rota nem recebeu tráfego de rede.

| Requisição construída | Status | Chamou a próxima função? |
| --- | --- | --- |
| GET sem token, sem Sec-Fetch-Site | 200 | Sim |
| POST sem token, sem Sec-Fetch-Site | 419 | Não |
| POST com token incorreto, sem Sec-Fetch-Site | 419 | Não |
| POST com _token correto, sem Sec-Fetch-Site | 200 | Sim |
| POST com X-CSRF-TOKEN correto, sem Sec-Fetch-Site | 200 | Sim |
| POST com Sec-Fetch-Site: same-origin e sem token | 200 | Sim |

Processo código 0, seis expectativas atendidas e zero consultas SQL, medidas
por listener. Não imprimimos tokens, cookies ou conteúdo de sessão. Nenhuma
sessão foi persistida em disco/banco, rota criada ou operação de negócio executada.
O status 419 aqui corresponde à falha de token; não é o 422 de validação de
page/nome estudado no catálogo.

## Ligação com o projeto e continuidade

O [bootstrap](../../backend/bootstrap/app.php) não recebeu exclusões CSRF nem
mudanças de middleware. As rotas de [api.php](../../backend/routes/api.php)
continuam leituras públicas no grupo api. O fluxo futuro de autenticação por
cookie da interface própria precisará integrar sessão e proteção à API.

Mudança somente documental. Sem nova suíte, comandos SQL ou quatro contratos;
última suíte completa permanece 7.7, 67 testes/635 asserções. A demonstração
verifica middleware e handler isolados, sem comprovar login, navegador ou
proteção completa de um endpoint ainda inexistente.

Entendimento confirmado com "entendi" em 03/11/2026. Próximo passo após publicar:
7.10 — entender o papel do Sanctum para autenticar a futura interface própria
por sessão/cookie e conectar esse fluxo à API. Checkpoint publicado e conferido
em f082f8096be91e504f633d892b73d3c5e1299093;
HEAD/origin/main/main remota iguais após push. Registro posterior à publicação.
