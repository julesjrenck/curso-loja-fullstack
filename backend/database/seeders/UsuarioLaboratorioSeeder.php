<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use LogicException;

class UsuarioLaboratorioSeeder extends Seeder
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

        $email = 'aluno@example.test';

        if (User::query()->where('email', $email)->exists()) {
            $this->command->info('A conta de laboratório já existe e foi preservada.');

            return;
        }

        $senha = $this->command->secret('Escolha uma senha exclusiva para a conta de laboratório', false);

        if (! is_string($senha) || strlen($senha) < 8 || strlen($senha) > 72) {
            throw new LogicException('A senha do laboratório deve ter entre 8 e 72 bytes.');
        }

        User::query()->create([
            'name' => 'Aluno do laboratório',
            'email' => $email,
            'password' => $senha,
        ]);

        $this->command->info('Conta de laboratório criada: aluno@example.test.');
    }
}
