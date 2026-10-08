<?php

header("Content-Type: text/plain; charset=UTF-8");

$appName = getenv("APP_NAME");

echo "Aplicação: " . $appName . PHP_EOL;
echo "Olá, Docker! Código local atualizado." . PHP_EOL;
echo "Versão do PHP: " . PHP_VERSION . PHP_EOL;
