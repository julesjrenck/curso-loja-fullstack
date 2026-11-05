<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use LogicException;

class AdministradorLaboratorioSeeder extends Seeder
{
    public function run(): void
    {
        if (! app()->environment('local')) {
            throw new LogicException('Este seeder exige o ambiente local.');
        }

        if (config('database.default') !== 'sqlsrv' || DB::connection()->getDatabaseName() !== 'loja') {
            throw new LogicException('Este seeder exige a conexão sqlsrv com o banco loja.');
        }

        if ($this->command === null || $this->command->option('no-interaction')) {
            throw new LogicException('Execute este seeder em um terminal interativo.');
        }

        $email = 'admin@example.test';

        if (User::query()->where('email', $email)->exists()) {
            $this->command->info('A conta admin@example.test já existe e foi preservada. Nenhuma permissão foi alterada.');

            return;
        }

        $senha = $this->command->secret('Escolha uma senha exclusiva para a conta administrativa do laboratório', false);

        if (! is_string($senha) || strlen($senha) < 8 || strlen($senha) > 72) {
            throw new LogicException('A senha do laboratório deve ter entre 8 e 72 bytes.');
        }

        $usuario = new User;
        $usuario->name = 'Administrador do laboratório';
        $usuario->email = $email;
        $usuario->password = $senha;
        $usuario->is_admin = true;
        $usuario->save();

        $this->command->info('Conta administrativa de laboratório criada: admin@example.test.');
    }
}
