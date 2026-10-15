<?php

namespace Database\Seeders;

use App\Models\Produto;
use Illuminate\Database\Seeder;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Produto::firstOrCreate(
            ['nome' => 'Camiseta'],
            [
                'preco_em_centavos' => 4990,
                'status' => 'ativo',
            ]
        );
    }
}
