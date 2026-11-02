#!/usr/bin/env bash
set -euo pipefail

cd "$(dirname "${BASH_SOURCE[0]}")/.."

codigo_http="${1:-404}"
operacao="${2:-consulta}"
flag_captura="CAPTURAR_CONTRATO_${codigo_http}"
caminho_api="/api/v1/produtos/{id}"

case "$operacao:$codigo_http" in
  consulta:200)
    filtro_teste="test_retorna_produto_ativo_pelo_id_em_json"
    ;;
  consulta:404)
    filtro_teste="test_retorna_404_em_json_para_id_inexistente"
    ;;
  listagem:200)
    filtro_teste="test_retorna_produto_ativo_em_json"
    flag_captura="CAPTURAR_CONTRATO_LISTAGEM_200"
    caminho_api="/api/v1/produtos"
    ;;
  listagem:422)
    filtro_teste="test_retorna_422_em_json_para_pagina_invalida@zero"
    flag_captura="CAPTURAR_CONTRATO_LISTAGEM_422"
    caminho_api="/api/v1/produtos"
    ;;
  *)
    printf 'Uso: bash scripts/validar-contrato-produto.sh [200|404|422] [consulta|listagem]\nConsulta aceita 200/404; listagem aceita 200/422.\n' >&2
    exit 2
    ;;
esac

arquivo_captura="${operacao}-${codigo_http}.json"

docker compose exec -T backend php -r '
$arquivo = "/app/storage/app/private/contratos/".$argv[1];
if (is_file($arquivo) && !unlink($arquivo)) {
    throw new RuntimeException("Não foi possível remover a captura anterior.");
}
' "$arquivo_captura"

docker compose exec -T -e "${flag_captura}=1" backend php artisan test \
  --do-not-cache-result \
  --filter="$filtro_teste"

pasta_temporaria=$(mktemp -d /tmp/curso-contrato-produto.XXXXXX)
trap 'rm -rf -- "$pasta_temporaria"' EXIT

docker compose exec -T backend php -r '
$codigoHttp = $argv[1];
$caminhoApi = $argv[2];
$nomeCaptura = $argv[3];
$documento = json_decode(stream_get_contents(STDIN), false, 512, JSON_THROW_ON_ERROR);
$conteudo = $documento->paths->{$caminhoApi}->get->responses->{$codigoHttp}->content->{"application/json"} ?? null;
if (!is_object($conteudo) || !isset($conteudo->schema)) {
    throw new RuntimeException("Schema JSON da resposta ".$codigoHttp." não encontrado.");
}

$arquivo = "/app/storage/app/private/contratos/".$nomeCaptura;
if (!is_file($arquivo)) {
    throw new RuntimeException("Captura da execução atual não encontrada.");
}
$corpo = file_get_contents($arquivo);
if ($corpo === false || $corpo === "") {
    throw new RuntimeException("Captura vazia ou ilegível.");
}

$conteudo->example = json_decode($corpo, false, 512, JSON_THROW_ON_ERROR);
echo json_encode($documento, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR).PHP_EOL;
' "$codigo_http" "$caminho_api" "$arquivo_captura" < docs/api/openapi.json > "$pasta_temporaria/openapi.json"

docker run --rm --network none \
  --volume "$PWD/docs/api/redocly.yaml:/spec/redocly.yaml:ro" \
  --volume "$pasta_temporaria/openapi.json:/spec/openapi.json:ro" \
  --workdir /spec \
  redocly/cli:2.65.0@sha256:42acee0d7e629a9d0376d8df579dc325e51da727de06a31036bccc02409a7e11 \
  lint openapi.json --config redocly.yaml
