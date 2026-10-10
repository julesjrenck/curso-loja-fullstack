<?php

declare(strict_types=1);

use Loja\Produto;
use Loja\StatusProduto;

if (PHP_SAPI !== "cli") {
    http_response_code(403);
    header("Content-Type: text/plain; charset=UTF-8");
    exit("Execute este exemplo pelo terminal." . PHP_EOL);
}

require_once __DIR__ . "/vendor/autoload.php";

$produto = new Produto("Camiseta", 4990);

echo "Produto: " . $produto->getNome() . PHP_EOL;
echo "Preço em centavos: " . $produto->getPrecoEmCentavos() . PHP_EOL;
echo "Status: " . $produto->getStatus()->value . PHP_EOL;

$produtoInativo = new Produto("Calça", 8990, StatusProduto::Inativo);

echo "Produto: " . $produtoInativo->getNome() . PHP_EOL;
echo "Status: " . $produtoInativo->getStatus()->value . PHP_EOL;

try {
    new Produto("Camiseta", -100);
} catch (InvalidArgumentException $erro) {
    echo "Produto recusado: " . $erro->getMessage() . PHP_EOL;
}
