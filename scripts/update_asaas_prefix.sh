#!/bin/bash

SCRIPT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

sed -i -r \
    's/(#?ASAAS_PREFIX=)(.*)/\1"'$(whoami)'-'$(date +%s)'-"/' \
    "$SCRIPT_DIR/../.env"
