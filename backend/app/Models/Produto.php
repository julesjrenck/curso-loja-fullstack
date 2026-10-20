<?php

namespace App\Models;

use Database\Factories\ProdutoFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['nome', 'preco_em_centavos', 'status', 'categoria_id'])]
class Produto extends Model
{
    /** @use HasFactory<ProdutoFactory> */
    use HasFactory;

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }

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
