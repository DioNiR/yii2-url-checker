#!/bin/sh

set -eu

# Waits for MySQL and applies DB migrations
docker/wait-for-it.sh mysql:3306 -t 3600

composer install --no-interaction
php yii migrate/up --interactive=0

# Executes container command
set -x
exec "$@"
