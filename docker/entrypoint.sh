#!/usr/bin/env sh
set -eu

cd /var/www/html

if [ ! -f ".env" ] && [ -f ".env.example" ]; then
  cp .env.example .env
fi

if [ ! -d "vendor" ]; then
  composer install --no-interaction --prefer-dist
fi

# Ensure writable dirs exist (Laravel needs these)
mkdir -p storage bootstrap/cache
chmod -R 775 storage bootstrap/cache || true

# Generate APP_KEY if missing/empty
if php -r 'exit((string)getenv("APP_KEY") !== "" ? 0 : 1);' 2>/dev/null; then
  :
else
  if php -r 'exit(file_exists(".env") ? 0 : 1);' 2>/dev/null; then
    if ! grep -qE '^APP_KEY=.+$' .env 2>/dev/null; then
      php artisan key:generate --force --ansi || true
    fi
  fi
fi

if [ "${RUN_MIGRATIONS:-true}" = "true" ]; then
  php artisan migrate --force --ansi || true

  if [ "${RUN_SEED:-false}" = "true" ]; then
    php artisan db:seed --force --ansi || true
  fi
fi

php artisan serve --host=0.0.0.0 --port="${APP_PORT:-8000}"
