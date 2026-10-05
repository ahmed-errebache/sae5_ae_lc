#!/bin/sh
set -e

# Dev uniquement : vendor/ n'est pas versionné, on l'installe au premier démarrage
if [ ! -f vendor/autoload_runtime.php ]; then
    echo "vendor/ absent -> composer install"
    composer install --prefer-dist --no-progress --no-interaction
fi

exec docker-php-entrypoint "$@"
