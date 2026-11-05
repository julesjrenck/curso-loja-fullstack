<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class UsuarioAdministradorMigrationTest extends TestCase
{
    use DatabaseTransactions;

    public function test_migration_define_padrao_sem_privilegio_e_reverte_sem_remover_usuarios(): void
    {
        $this->assertTrue(app()->environment('testing'));
        $this->assertSame('sqlsrv', config('database.default'));
        $this->assertSame('loja_test', DB::connection()->getDatabaseName());

        $identidade = DB::selectOne(
            'SELECT DB_NAME() AS banco, SUSER_SNAME() AS login, USER_NAME() AS usuario'
        );

        $this->assertSame('loja_test', $identidade->banco);
        $this->assertSame('loja_testes', $identidade->login);
        $this->assertSame('loja_testes', $identidade->usuario);
        $this->assertSame(0, User::query()->count());

        $historicoAntes = DB::table('migrations')->count();
        $migration = require database_path('migrations/2026_11_05_120000_add_is_admin_to_users_table.php');

        if (Schema::hasColumn('users', 'is_admin')) {
            $migration->down();
        }

        $anterior = User::query()->create([
            'name' => 'Conta anterior fictícia',
            'email' => 'anterior-migration@example.test',
            'password' => 'senha-ficticia-do-teste',
        ]);

        $migration->up();

        $this->assertTrue(Schema::hasColumn('users', 'is_admin'));

        $coluna = DB::selectOne(<<<'SQL'
            SELECT t.name AS tipo, c.is_nullable AS anulavel, d.definition AS padrao
            FROM sys.columns AS c
            JOIN sys.types AS t ON t.user_type_id = c.user_type_id
            LEFT JOIN sys.default_constraints AS d ON d.object_id = c.default_object_id
            WHERE c.object_id = OBJECT_ID(N'dbo.users') AND c.name = N'is_admin'
            SQL);

        $this->assertNotNull($coluna);
        $this->assertSame('bit', $coluna->tipo);
        $this->assertSame(0, (int) $coluna->anulavel);
        $this->assertNotNull($coluna->padrao);
        $this->assertSame('0', trim($coluna->padrao, "()' "));
        $this->assertTrue(DB::table('users')->where('id', $anterior->id)->where('is_admin', false)->exists());

        $novo = User::query()->create([
            'name' => 'Conta nova fictícia',
            'email' => 'nova-migration@example.test',
            'password' => 'senha-ficticia-do-teste',
        ]);

        $this->assertTrue(DB::table('users')->where('id', $novo->id)->where('is_admin', false)->exists());

        $migration->down();

        $this->assertFalse(Schema::hasColumn('users', 'is_admin'));
        $this->assertSame(2, User::query()->count());
        $this->assertDatabaseHas('users', [
            'id' => $anterior->id,
            'name' => 'Conta anterior fictícia',
            'email' => 'anterior-migration@example.test',
        ]);
        $this->assertDatabaseHas('users', [
            'id' => $novo->id,
            'name' => 'Conta nova fictícia',
            'email' => 'nova-migration@example.test',
        ]);
        $this->assertSame($historicoAntes, DB::table('migrations')->count());
    }
}
