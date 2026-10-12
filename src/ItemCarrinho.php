<?php

declare(strict_types=1);

namespace Loja;

use InvalidArgumentException;

class ItemCarrinho
{
    public function __construct(
        private Produto $produto,
        private int $quantidade,
    ) {
        if ($quantidade < 1) {
            throw new InvalidArgumentException("A quantidade do item deve ser maior que zero.");
        }
    }

    public function getProduto(): Produto
    {
        return $this->produto;
    }

    public function getQuantidade(): int
    {
        return $this->quantidade;
    }
}
