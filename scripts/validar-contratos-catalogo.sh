#!/usr/bin/env bash
set -euo pipefail

cd "$(dirname "${BASH_SOURCE[0]}")/.."

bash scripts/validar-contrato-produto.sh 200 consulta
bash scripts/validar-contrato-produto.sh 404 consulta
bash scripts/validar-contrato-produto.sh 200 listagem
bash scripts/validar-contrato-produto.sh 422 listagem

printf 'Contratos do catálogo: quatro casos validados.\n'
