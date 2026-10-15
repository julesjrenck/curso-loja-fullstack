<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['nome', 'preco_em_centavos', 'status'])]
class Produto extends Model
{
    //
}
