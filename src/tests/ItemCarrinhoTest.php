<?php

declare(strict_types=1);

use Loja\ItemCarrinho;
use Loja\Produto;
use PHPUnit\Framework\TestCase;

class ItemCarrinhoTest extends TestCase
{
    public function testCalculaSubtotalParaTresUnidades(): void
    {
        $produto = new Produto("Camiseta", 4990);
        $item = new ItemCarrinho($produto, 3);

        $subtotal = $item->getSubtotalEmCentavos();

        $this->assertSame(14970, $subtotal);
    }

    public function testRecusaQuantidadeZero(): void
    {
        $produto = new Produto("Camiseta", 4990);

        $this->expectException(InvalidArgumentException::class);

        new ItemCarrinho($produto, 0);
    }

    public function testRecusaQuantidadeNegativa(): void
    {
        $produto = new Produto("Camiseta", 4990);

        $this->expectException(InvalidArgumentException::class);

        new ItemCarrinho($produto, -1);
    }
}
