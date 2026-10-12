<?php

declare(strict_types=1);

use Loja\ItemCarrinho;
use Loja\Produto;

if (PHP_SAPI !== "cli") {
    http_response_code(403);
    header("Content-Type: text/plain; charset=UTF-8");
    exit("Execute este exemplo pelo terminal." . PHP_EOL);
}

require_once __DIR__ . "/vendor/autoload.php";

$produto = new Produto("Camiseta", 4990);
$item = new ItemCarrinho($produto, 3);

echo "Produto do item: " . $item->getProduto()->getNome() . PHP_EOL;
echo "Preço unitário em centavos: " . $item->getProduto()->getPrecoEmCentavos() . PHP_EOL;
echo "Quantidade: " . $item->getQuantidade() . PHP_EOL;
echo "Subtotal em centavos: " . $item->getSubtotalEmCentavos() . PHP_EOL;
