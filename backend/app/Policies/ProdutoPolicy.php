<?php

namespace App\Policies;

use App\Models\Produto;
use App\Models\User;

class ProdutoPolicy
{
    public function update(User $user, Produto $produto): bool
    {
        return $user->is_admin === true;
    }
}
