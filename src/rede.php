<?php

if (PHP_SAPI !== "cli") {
    http_response_code(403);
    header("Content-Type: text/plain; charset=UTF-8");
    exit("Execute este diagnóstico pelo terminal." . PHP_EOL);
}

$host = "php";
$ip = gethostbyname($host);

if ($ip === $host) {
    throw new RuntimeException("Não foi possível resolver o nome do serviço.");
}

$url = "http://" . $host . ":8000/";
$contexto = stream_context_create(["http" => ["timeout" => 5]]);
$cabecalhos = get_headers($url, false, $contexto);

if ($cabecalhos === false) {
    throw new RuntimeException("Não foi possível acessar o servidor pela rede.");
}

echo "Serviço: " . $host . PHP_EOL;
echo "IP resolvido: " . $ip . PHP_EOL;
echo "URL interna: " . $url . PHP_EOL;
echo "Resposta: " . $cabecalhos[0] . PHP_EOL;
