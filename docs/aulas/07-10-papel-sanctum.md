# Aula 7.10 — Papel do Sanctum na API da loja

Apresentada e verificada por leitura/diagnóstico em 03/11/2026, após confirmação
da 7.9 com "entendi". Checkpoint anterior publicado e conferido em
f082f8096be91e504f633d892b73d3c5e1299093; HEAD/origin/main/main remota iguais
após push. Entendimento da 7.10 confirmado com "entendi" em 04/11/2026.

## Objetivo

Ligar os conceitos de sessão, cookie e CSRF à API. Sanctum oferece suporte
às chamadas do navegador da nossa futura interface própria e também a
autenticação com tokens de API. Nesta etapa mudamos apenas documentação.

| Modo | Identificação enviada pelo cliente | Uso neste curso |
| --- | --- | --- |
| Interface própria no navegador | Cookie de sessão | Modo adotado para a interface da loja |
| Token de API | Authorization: Bearer com token válido | Comparação conceitual, sem emissão de tokens agora |

No primeiro modo, Sanctum usa a autenticação de sessão do Laravel. O guard web
continua participando do login. Adotar Sanctum não exige emitir um token de API
para a interface própria. A integração específica com renderização no servidor
do Next.js será aprofundada no módulo de integração.

## Fluxo planejado

1. O navegador chama GET /sanctum/csrf-cookie para preparar a proteção CSRF.
2. Envia credenciais e informação CSRF à rota de login, que ainda construiremos.
3. Após autenticar, usa o cookie nas chamadas à API, com CSRF quando necessário.
4. O middleware auth:sanctum exige autenticação nas rotas que receberem essa proteção.

O endpoint csrf-cookie é infraestrutura de autenticação; as APIs de negócio
continuam sob /api/v1. A URL da futura rota de login ainda será definida.
Preparar CSRF não faz login. O cookie XSRF-TOKEN dá suporte ao cabeçalho
X-XSRF-TOKEN do cliente HTTP; é diferente do cookie que referencia a sessão.

## Duas peças de configuração futura

| Peça | Responsabilidade |
| --- | --- |
| statefulApi() no bootstrap | Habilitar a preparação de sessão/cookies/CSRF nas requisições reconhecidas como da interface própria |
| auth:sanctum na rota | Exigir que a requisição esteja autenticada |

A preparação stateful não concede login a um visitante. A exigência de
autenticação também não define permissão de administrador; isso continua sendo
autorização. As duas leituras públicas do catálogo não recebem proteção nova
por estarmos introduzindo o pacote.

Serão necessárias configurações coerentes de endereços confiáveis, cookies e
CORS para o navegador. O modo SPA pressupõe frontend/backend no mesmo domínio
principal, podendo usar subdomínios; portas também importam na lista stateful.
Vamos conferir os endereços concretos quando configurarmos esse acesso.

Sanctum não fornece sozinho a nossa rota de login: implementaremos esse fluxo
usando os serviços de autenticação do Laravel. Instalar, configurar e ter login
funcionando são checkpoints diferentes.

Referência: [Sanctum e autenticação da interface própria](https://laravel.com/docs/13.x/sanctum#spa-authentication).

## Ponto de partida conferido

O [composer.json](../../backend/composer.json) não requer laravel/sanctum.
Um diagnóstico PHP no Docker leu esse arquivo e o
[composer.lock](../../backend/composer.lock) com JSON_THROW_ON_ERROR e consultou
Composer\InstalledVersions::isInstalled('laravel/sanctum'). Todos indicaram
ausência do pacote, código 0. Não executamos require, install ou update.

O mesmo diagnóstico carregou aplicação/kernel HTTP e confirmou guard padrão
web com driver session/provider users. O grupo api contém somente
SubstituteBindings, como na 7.8. O [bootstrap](../../backend/bootstrap/app.php)
não tem statefulApi habilitado e as [rotas](../../backend/routes/api.php)
continuam as duas leituras públicas do catálogo.

Essas consultas confirmam dependências e configuração atuais; não demonstram
o comportamento de um Sanctum ainda não instalado. Não criamos sessão, usuário,
token, endpoint ou tabela. Nenhum valor privado foi impresso.

Sem mudança de aplicação/configuração/dependência, SQL, nova suíte ou quatro
contratos. Última suíte completa permanece 7.7: 67 testes/635 asserções.

## Continuidade

Entendimento confirmado com "entendi" em 04/11/2026. Próximo passo após publicar:
7.11 — conferir compatibilidade e adicionar somente laravel/sanctum pelo Composer
no Docker, revisando composer.json/lock, sem aplicar migrations ou configurar
o fluxo de autenticação nessa instalação. Checkpoint publicado e conferido em
63c0f1eafb1b33a9e5591aae2d8617aa1890a4c6; HEAD/origin/main/main remota iguais
após push. Registro posterior à publicação.
