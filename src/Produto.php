<?php

declare(strict_types=1);

namespace Loja;

use InvalidArgumentException;

class Produto
{
    public function __construct(
        private string $nome,
        private int $precoEmCentavos,
        private StatusProduto $status = StatusProduto::Ativo,
    ) {
        if (trim($nome) === "") {
            throw new InvalidArgumentException("O nome do produto não pode ser vazio.");
        }

        if ($precoEmCentavos < 0) {
            throw new InvalidArgumentException("O preço em centavos não pode ser negativo.");
        }
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getPrecoEmCentavos(): int
    {
        return $this->precoEmCentavos;
    }

    public function getStatus(): StatusProduto
    {
        return $this->status;
    }
}
