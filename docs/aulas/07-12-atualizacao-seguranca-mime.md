# Aula 7.12 — Atualização de segurança de symfony/mime

Atualização, explicação e verificações em 04/11/2026, após confirmação da 7.11
com "entendi". Checkpoint anterior publicado e conferido em
0cf2c8278c19db2711cebc7e40830bbde61c965a; HEAD/origin/main/main remota iguais
após push. Entendimento da 7.12 confirmado com "entendi" em 04/11/2026.

## Objetivo e conceito

Corrigir o aviso CVE-2026-45070 identificado na 7.11. symfony/mime é uma
dependência indireta já utilizada pelo Laravel; o projeto não a declara
diretamente em composer.json. A versão v8.1.7 estava afetada. A
[publicação oficial do Symfony](https://symfony.com/cve-2026-45070) identifica
v8.1.10 como primeira correção na linha 8.1, para validação dos nomes de
parâmetros em cabeçalhos MIME.

Atualizamos somente esse pacote: v8.1.7 → v8.1.10. Nenhuma funcionalidade
nova da aplicação foi construída nesta manutenção.

## Compatibilidade e simulação

Consultamos no Docker:

```sh
docker compose exec -T backend composer show symfony/mime 8.1.10 --all --no-interaction --no-plugins
```

Os metadados exigem PHP >=8.4.1, atendido pelo PHP 8.4.26 do container.
A resolução do Composer também conferiu as restrições das outras dependências.
Antes da aplicação, repetimos o update abaixo com --dry-run: zero instalações,
uma atualização e zero remoções. Git e hashes confirmaram que a simulação
preservou JSON/lock. Ela ainda informou o aviso no estado não atualizado;
a auditoria decisiva foi executada após a aplicação real.

## Comando aplicado

```sh
docker compose run --rm --no-deps --workdir /instalacao \
  --volume ./backend:/instalacao:rw \
  --volume curso-loja-fullstack_vendor-backend:/instalacao/vendor \
  backend composer update 'symfony/mime:8.1.10' \
  --minimal-changes --no-scripts --no-plugins --no-interaction --no-progress
```

Usamos o mesmo container temporário e as montagens da 7.11: backend gravável
em /instalacao e volume vendor-backend compartilhado com o serviço normal.
--rm remove o container ao terminar; --no-deps evita iniciar outros serviços.

update seleciona e instala a nova versão do pacote indicado. A expressão
symfony/mime:8.1.10 é uma restrição temporária para essa resolução, sem adicionar
uma dependência direta ao JSON. --minimal-changes pede ao Composer que preserve
as demais versões sempre que possível; a comparação posterior confirmou o
resultado efetivo. --no-scripts e --no-plugins mantêm a descoberta do Sanctum
adiada. As opções finais dispensam interação e simplificam a saída.

Resultado código 0: uma atualização de v8.1.7 para v8.1.10, zero adições/remoções.

## Arquivos e pacotes conferidos

| Arquivo/local | Resultado |
| --- | --- |
| [composer.json](../../backend/composer.json) | Idêntico ao checkpoint anterior |
| [composer.lock](../../backend/composer.lock) | Somente o registro de symfony/mime mudou |
| Volume vendor-backend | symfony/mime v8.1.10 instalado e autoload gerado |
| Manifests packages.php/services.php | Hashes preservados; Sanctum ainda não descoberto |

O lock agora fixa a referência 8d1232052c9cdef170ed9608b3147bca4f61ff69.
A comparação estruturada encontrou somente symfony/mime alterado, nenhum pacote
adicionado/removido e metadados externos à lista packages preservados, inclusive
content-hash. A contagem permanece 110; Sanctum permanece v4.3.3. JSON/lock
mantiveram proprietário 1000:1000.

Esse caso diferencia três comandos já estudados: require declara dependências;
update resolve novas versões; install reproduz as versões do lock. A atualização
de uma dependência indireta permitida pelas restrições existentes pode mudar
somente o lockfile versionado, além dos arquivos instalados no volume.

## Auditoria e validação

```sh
docker compose exec -T backend composer audit --locked --format=json --no-interaction --no-plugins
docker compose exec -T backend composer validate --strict
docker compose exec -T backend composer check-platform-reqs
docker compose exec -T backend php vendor/bin/phpunit --colors=never --do-not-cache-result
```

audit --locked consulta os pacotes registrados no lock. Após a atualização,
retornou 0 com advisories/abandoned/filter vazios. O aviso observado na 7.11
foi resolvido nessa consulta. Uma auditoria sem avisos não é prova de ausência
de qualquer vulnerabilidade desconhecida.

validate --strict e check-platform-reqs passaram. A suíte existente passou com
67 testes/635 asserções, código 0. Não criamos testes para o código interno
da biblioteca; usamos a versão corrigida indicada pela fonte e verificamos
as regressões cobertas na aplicação.

Diagnóstico PHP comparou os 110 pacotes reais de installed.json/InstalledVersions
com o lock, sem divergências de nomes/versões/referências. Confirmou versão
instalada v8.1.10 e preservação dos hashes dos manifests. Sanctum continua
ausente do manifest; package:discover ainda não foi executado.

Depois da suíte, loja_test/loja_testes manteve seis tabelas, quatro migrations
nos lotes 1/2/3/4 e zero users/tokens/sessions/produtos/categorias. Nenhuma
migration foi aplicada. Snapshot normal e quatro contratos não foram repetidos.
Fonte adicional: [Composer update](https://getcomposer.org/doc/03-cli.md#update-u-upgrade).

## Continuidade

Entendimento confirmado com "entendi" em 04/11/2026. Próximo passo após publicar:
7.13 — executar package:discover, explicar os manifests atualizados e conferir
o registro do SanctumServiceProvider e da rota /sanctum/csrf-cookie, antes de
habilitar statefulApi ou implementar login. Correção explicada/verificada e
entendimento confirmado. Checkpoint preparado para commit e push; consultar
o Git ou registro posterior para conferir a publicação.
