<?php

declare(strict_types=1);

use Loja\StatusProduto;

if (PHP_SAPI !== "cli") {
    http_response_code(403);
    header("Content-Type: text/plain; charset=UTF-8");
    exit("Execute este exemplo pelo terminal." . PHP_EOL);
}

require_once __DIR__ . "/vendor/autoload.php";

$status = StatusProduto::Ativo;

echo "Caso: " . $status->name . PHP_EOL;
echo "Valor: " . $status->value . PHP_EOL;
