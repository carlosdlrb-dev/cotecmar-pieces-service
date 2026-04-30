# Pieces Service (Laravel 11)

Servicio de gestion de proyectos, bloques y piezas con API REST en JSON.

## Requisitos

- PHP 8.2+
- Composer
- JWT Secret compartido con el Auth Service

## Variables de entorno

- `APP_KEY`
- `APP_URL`
- `JWT_SECRET` debe ser exactamente el mismo valor que usa el Auth Service
- `DB_*`

## Instalacion y ejecucion

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve
```

## Autenticacion

Todas las rutas estan protegidas por token JWT. Este servicio valida los tokens con el mismo `JWT_SECRET` configurado en el Auth Service, asi que ambos `.env` deben compartir ese valor.

Enviar el header:

```
Authorization: Bearer <token>
Accept: application/json
```

## Endpoints principales (v1)

### Proyectos

- `GET /api/v1/proyectos`
- `POST /api/v1/proyectos`
- `GET /api/v1/proyectos/{id}`
- `PUT /api/v1/proyectos/{id}`
- `DELETE /api/v1/proyectos/{id}`

### Bloques

- `GET /api/v1/proyectos/{proyecto}/bloques`
- `POST /api/v1/proyectos/{proyecto}/bloques`
- `GET /api/v1/bloques/{id}`
- `PUT /api/v1/bloques/{id}`
- `DELETE /api/v1/bloques/{id}`

### Piezas

- `GET /api/v1/piezas?proyecto_id=&estado=&page=`
- `POST /api/v1/bloques/{bloque}/piezas`
- `GET /api/v1/piezas/{id}`
- `PUT /api/v1/piezas/{id}`
- `DELETE /api/v1/piezas/{id}`

### Reportes

- `GET /api/v1/reportes/pendientes-por-proyecto`
- `GET /api/v1/reportes/totales-por-estado`

## Decisiones tecnicas

- Laravel 11 con Eloquent ORM y migraciones.
- Soft delete en cascada para proyectos, bloques y piezas.
- JWT local para validacion de token en este servicio.
