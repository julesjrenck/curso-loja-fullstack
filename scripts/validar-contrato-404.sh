#!/usr/bin/env bash
set -euo pipefail

cd "$(dirname "${BASH_SOURCE[0]}")/.."

docker compose exec -T backend php -r '
$arquivo = "/app/storage/app/private/contratos/consulta-404.json";
if (is_file($arquivo) && !unlink($arquivo)) {
    throw new RuntimeException("Não foi possível remover a captura anterior.");
}
'

docker compose exec -T -e CAPTURAR_CONTRATO_404=1 backend php artisan test \
  --do-not-cache-result \
  --filter=test_retorna_404_em_json_para_id_inexistente

pasta_temporaria=$(mktemp -d /tmp/curso-contrato-404.XXXXXX)
trap 'rm -rf -- "$pasta_temporaria"' EXIT

docker compose exec -T backend php -r '
$documento = json_decode(stream_get_contents(STDIN), false, 512, JSON_THROW_ON_ERROR);
$conteudo = $documento->paths->{"/api/v1/produtos/{id}"}->get->responses->{"404"}->content->{"application/json"} ?? null;
if (!is_object($conteudo) || !isset($conteudo->schema)) {
    throw new RuntimeException("Schema JSON da resposta 404 não encontrado.");
}

$arquivo = "/app/storage/app/private/contratos/consulta-404.json";
if (!is_file($arquivo)) {
    throw new RuntimeException("Captura da execução atual não encontrada.");
}
$corpo = file_get_contents($arquivo);
if ($corpo === false || $corpo === "") {
    throw new RuntimeException("Captura vazia ou ilegível.");
}

$conteudo->example = json_decode($corpo, false, 512, JSON_THROW_ON_ERROR);
echo json_encode($documento, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR).PHP_EOL;
' < docs/api/openapi.json > "$pasta_temporaria/openapi.json"

docker run --rm --network none \
  --volume "$PWD/docs/api/redocly.yaml:/spec/redocly.yaml:ro" \
  --volume "$pasta_temporaria/openapi.json:/spec/openapi.json:ro" \
  --workdir /spec \
  redocly/cli:2.65.0@sha256:42acee0d7e629a9d0376d8df579dc325e51da727de06a31036bccc02409a7e11 \
  lint openapi.json --config redocly.yaml
