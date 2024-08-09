#!/bin/bash

script_dir="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
project_root="$script_dir/.."

if [[ ! -f "$project_root/.env" ]]
then
    echo ".env not found"
    exit 1
fi

"$project_root/scripts/update_asaas_prefix.sh"

source "$project_root/.env"

sed -r \
    -e 's/^(#?DB_DATABASE=)(.*)/\1"'$DB_DATABASE'_testing"/g' \
    -e 's/^(#?ASAAS_PREFIX=)(.*)/\1"test-'$(whoami)'-'$(date +%s)'-"/g' \
    -e 's/^(#?HORIZON_PREFIX=)(.*)/\1"test-'$HORIZON_PREFIX'"/g' \
    "$project_root/.env" \
    > .env.testing

$script_dir/dump_tests_clean_db.sh
