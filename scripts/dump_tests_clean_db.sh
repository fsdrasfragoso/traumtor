#!/bin/bash

script_dir="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
project_root="$script_dir/.."

if [[ ! -f "$project_root/.env.testing" ]]
then
    echo ".env.testing not found"
    exit 1
fi

source "$project_root/.env.testing"

export PGHOST=$DB_HOST
export PGDATABASE=$DB_DATABASE
export PGUSER=$DB_USERNAME
export PGPASSWORD=$DB_PASSWORD
psql \
    -c "select pg_terminate_backend(pg_stat_activity.pid) from pg_stat_activity where pg_stat_activity.datname = '"$PGDATABASE"' and pid <> pg_backend_pid();"
dropdb --if-exists $PGDATABASE
createdb $PGDATABASE

php artisan --env=testing migrate
php artisan --env=testing db:seed

pg_dump -v | sed -r -e '/^--/ d' -e '/^$/d' > "$project_root/database/clean_dump.sql"
