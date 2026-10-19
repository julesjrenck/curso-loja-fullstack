# Aula 5.37 — Configuração local Laravel de testes

## Objetivo e estado

Preparar backend/.env.testing a partir do modelo público da 5.36 e verificar
o carregamento pelo Laravel e a conexão SQL Server por leitura. Implementação
e explicação em 19/10/2026; entendimento confirmado com "entendi" nessa data.

A 5.36 foi confirmada com "entendi" e publicada em 1c8c380. HEAD, origin/main
e consulta direta à main remota retornaram
1c8c3801f6ecfd62a8b6b0c7749caff24fde8582 após o push.

## Arquivo local

Somente backend/.env.testing foi criado para a configuração desta etapa.
Ele permanece ignorado pelo Git e não será publicado. Em novo clone será
necessário prepará-lo novamente com os valores locais disponíveis.

Uma rotina temporária em PHP Docker leu o modelo e os arquivos de origem com
phpdotenv, sem imprimir valores privados. Preencheu apenas APP_KEY e DB_PASSWORD:

```php
$key = 'base64:' . base64_encode(
    Encrypter::generateKey('AES-256-CBC')
);

$password = $source['MSSQL_TESTS_PASSWORD'];
```

Encrypter é a classe de criptografia do Laravel. generateKey gera os bytes
aleatórios adequados ao algoritmo configurado em config/app.php; neste projeto,
AES-256-CBC usa chave de 32 bytes. base64_encode representa esses bytes como
texto para guardar no arquivo. O prefixo base64: informa ao Laravel como ler
essa representação; não é uma proteção que dispense manter o arquivo privado.

APP_KEY é usada pela criptografia Laravel e foi gerada especificamente para
testes. DB_PASSWORD autentica a conexão SQL: recebeu a senha já pertencente ao
login loja_testes. Não houve troca de senha, criação de conta ou mudança na
chave da aplicação normal.

O arquivo foi criado com abertura exclusiva, evitando sobrescrever conteúdo
existente, e umask 0077, resultando em permissão 600, dono 1000:1000. Hashes
comparados internamente confirmaram preservação do .env da raiz, backend/.env
e modelo público. A rotina temporária permaneceu fora do repositório.

## Carregamento do ambiente

Foi conferida a ausência de bootstrap/cache/config.php. Um diagnóstico
temporário iniciou Laravel recebendo --env=testing. O carregador selecionou
.env.testing e o diagnóstico conferiu app.env, arquivo selecionado, conexão,
host, porta, banco, login e igualdade da chave/senha com o arquivo local,
sem exibir esses dois valores.

Também confirmou chave diferente da normal, 32 bytes após decodificação,
criptografia/descriptografia de texto diagnóstico, cache/sessão/mail array
e fila sync. O SELECT confirmou loja_test, login/usuário loja_testes,
HAS_DBACCESS loja = 0 e zero tabelas. Nenhum comando de alteração de banco.

Depois reutilizamos o comando já estudado na 5.9:

```bash
docker compose exec -T backend php artisan loja:verificar-banco --env=testing --no-ansi
```

docker compose exec executa dentro do backend ativo; -T permite a execução
sem terminal interativo. php artisan inicia o console Laravel.
loja:verificar-banco executa o SELECT de identidade já existente em
routes/console.php. --env=testing solicita .env.testing; --no-ansi remove
códigos de cor da saída. Resultado:

```text
Banco: loja_test
Login: loja_testes
Usuário: loja_testes
```

A mesma execução sem --env=testing retornou loja/loja_app. Cada processo carrega
seu ambiente; a opção não altera permanentemente o servidor HTTP nem as
execuções normais. As duas execuções terminaram com código 0.

## Verificações e continuidade

git check-ignore confirmou .env.testing, backend/.env e .env ignorados;
git ls-files não listou esses arquivos. stat conferiu permissão 600. Modelo
público e configurações existentes preservados; git diff --check passou.

Não houve mudança em phpunit.xml, config/database.php, código da aplicação,
serviços ou dependências; nenhuma suíte, migration ou seeder executado.
phpunit.xml ainda usa SQLite/:memory:. O diagnóstico com Artisan comprova o
ambiente selecionado nesse comando, não a configuração efetiva de uma suíte.

Entendimento da 5.37 confirmado com "entendi" em 19/10/2026. Publicar apenas os
registros e iniciar 5.38, alinhando phpunit.xml ao SQL Server de testes e
verificando sua configuração antes de executar qualquer suíte ou criar tabelas.
