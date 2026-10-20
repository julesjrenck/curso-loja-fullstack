<?php

namespace App\Models;

use Database\Factories\ProdutoFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['nome', 'preco_em_centavos', 'status'])]
class Produto extends Model
{
    /** @use HasFactory<ProdutoFactory> */
    use HasFactory;

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'preco_em_centavos' => 'integer',
        ];
    }
}
