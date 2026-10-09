<?php

declare(strict_types=1);

class Produto
{
    private string $nome;
    private int $precoEmCentavos;

    public function __construct(string $nome, int $precoEmCentavos)
    {
        $this->nome = $nome;
        $this->precoEmCentavos = $precoEmCentavos;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getPrecoEmCentavos(): int
    {
        return $this->precoEmCentavos;
    }
}
