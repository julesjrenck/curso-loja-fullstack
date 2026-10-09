<?php

if (PHP_SAPI !== "cli") {
    http_response_code(403);
    header("Content-Type: text/plain; charset=UTF-8");
    exit("Execute este exemplo pelo terminal." . PHP_EOL);
}

$arquivo = "/dados/contador.txt";
$conteudo = file_exists($arquivo) ? file_get_contents($arquivo) : "0";

if ($conteudo === false) {
    throw new RuntimeException("Não foi possível ler o contador.");
}

$contador = (int) $conteudo + 1;

if (file_put_contents($arquivo, (string) $contador) === false) {
    throw new RuntimeException("Não foi possível salvar o contador.");
}

echo "Execuções registradas: " . $contador . PHP_EOL;
