#!/bin/sh

set -eu

# Waits for MySQL and applies DB migrations
docker/wait-for-it.sh mysql:3306 -t 3600
docker/wait-for-it.sh rabbitmq:5672 -t 3600

composer install --no-interaction
php yii migrate/up --interactive=0

php yii check-url/load-to-queue

chmod +x /app/docker/check_and_run.sh
docker/check_and_run.sh

# Executes container command
set -x
exec "$@"
