# Aula 5.12 — Colunas da migration de produtos

## Objetivo

Traduzir a modelagem 5.10 para os métodos do Blueprint. O arquivo inicial da
5.11 foi confirmado com "entendi" e publicado em 3e5cb93, SHA completo
3e5cb9370b37ddc666d4ccd84441589644a0256f, conferido na main remota.

Alteramos somente o corpo da definição de colunas em
backend/database/migrations/2026_10_14_123220_create_produtos_table.php.
A tabela será criada em etapa própria; esta aula prepara e verifica o código.

## Colunas preenchidas

```php
Schema::create('produtos', function (Blueprint $table) {
    $table->id();
    $table->string('nome', 150);
    $table->integer('preco_em_centavos');
    $table->string('status', 20)->default('ativo');
    $table->timestamps(3);
});
```

O Blueprint recebe os pedidos de colunas. O Laravel usa o compilador de
esquema específico da conexão sqlsrv para produzir o SQL correspondente.

| Código | SQL Server gerado | Significado |
| --- | --- | --- |
| id() | BIGINT NOT NULL IDENTITY PRIMARY KEY | Identificador gerado e único |
| string('nome', 150) | NVARCHAR(150) NOT NULL | Nome Unicode com tamanho definido |
| integer('preco_em_centavos') | INT NOT NULL | Preço inteiro em centavos |
| string('status', 20)->default('ativo') | NVARCHAR(20) NOT NULL DEFAULT 'ativo' | Estado com valor inicial quando omitido |
| timestamps(3) | created_at/updated_at DATETIME2(3) NULL | Datas com três casas de fração de segundo |

Cada string recebe o nome da coluna e seu tamanho. integer recebe o nome
da coluna e usa o tipo inteiro. A unidade monetária continua sendo centavos:
4990 representa R$ 49,90. Os campos nome, preço e status são NOT NULL por
padrão, pois não usamos nullable() neles.

string('status', 20) devolve uma definição de coluna. Encadear ->default('ativo')
configura essa mesma coluna. O default é do banco: quando um INSERT omitir
status, o banco usará ativo. Se o INSERT informar inativo, esse valor será usado;
se informar NULL explicitamente, não será substituído pelo default e a coluna
NOT NULL recusará o valor. Não fizemos inserções nesta aula.

default não limita os estados permitidos. NVARCHAR(20) permite outros textos,
e INT permite preços negativos. Nome com conteúdo, preço não negativo e conjunto
ativo/inativo continuam como regras de negócio documentadas; validações e
restrições terão implementação nas etapas próprias.

timestamps(3) substitui timestamps() do gerador para cumprir a modelagem
DATETIME2(3). O Laravel cria duas definições de coluna e permite NULL nelas.
O método não adiciona valor padrão de data atual; preenchimento por Eloquent
será apresentado quando introduzirmos o model. A aplicação já usa UTC.

## Arquivo e relações

Imports, classe anônima, up() e down() continuam como na 5.11. up contém
Schema::create; down descreve Schema::dropIfExists('produtos') na reversão.
O arquivo de modelagem é a referência dos campos e dos tipos; a migration
expressa esse desenho em PHP. Não alteramos controller, catálogo ou Blade.

## Verificação sem aplicar a migration

```bash
docker compose exec -T backend php -l \
  /app/database/migrations/2026_10_14_123220_create_produtos_table.php
```

php -l verificou a sintaxe e passou. Um programa temporário PHP em Docker
inicializou Laravel, carregou a migration e usou:

```php
$consultas = $conexao->pretend(function () use ($migration) {
    $migration->up();
});
```

pretend faz o Laravel registrar as instruções que geraria sem executar essas
instruções no banco. Não usamos artisan migrate --pretend, nem migrate ou
rollback; usamos a simulação da conexão diretamente para verificar este arquivo.
up foi chamado dentro da simulação, sem aplicar DDL ao servidor.

O diagnóstico conferiu que houve uma única instrução CREATE TABLE com os tipos,
NOT NULL, identidade/chave, default e datas esperados. SQL capturado:

```sql
create table "produtos" (
    "id" bigint not null identity primary key,
    "nome" nvarchar(150) not null,
    "preco_em_centavos" int not null,
    "status" nvarchar(20) not null default 'ativo',
    "created_at" datetime2(3) null,
    "updated_at" datetime2(3) null
)
```

Depois, um SELECT real somente de metadados em sys.tables confirmou banco loja
e ausência de dbo.produtos/dbo.migrations. Portanto a simulação comprova
compilação do desenho; aceitação do DDL pelo servidor e esquema persistido
serão verificados quando aplicarmos a migration na etapa própria.

git diff --check passou. Apenas a migration e os registros da aula mudaram.
Nenhum dado, serviço, imagem, dependência ou credencial foi alterado. Testes
de integração terão banco SQL Server exclusivo e preparação própria.

## Continuidade

Colunas implementadas, explicação apresentada e verificações concluídas.
Entendimento da 5.12 confirmado com "entendi" em 14/10/2026. Checkpoint
publicado e conferido em bbec195: HEAD, origin/main e main remota retornaram
bbec195570dc903909bc0a629ce78c57e9ed5d6a. Registro no checkpoint seguinte.
Próximo passo iniciado na
5.13: preparar login/usuário exclusivo de migrations no banco loja, explicando
permissões de estrutura versus dados e mantendo a conta da aplicação com seu
escopo atual. Execução da migration ficará para a etapa própria.

Fontes consultadas em 14/10/2026:

- [Tipos e modificadores de colunas Laravel 13](https://laravel.com/docs/13.x/migrations#available-column-types).
- Compilador instalado: Illuminate\Database\Schema\Grammars\SqlServerGrammar,
  métodos typeString, typeInteger e typeTimestamp; leitura dos trechos relevantes
  e SQL efetivamente capturado na simulação.
