<p align="center">
  <img src="https://cdn.simpleicons.org/github/181717" width="96" alt="GitHub">
</p>

# Sistema Market

Aplicacion web en Laravel para la gestion de un minimarket: usuarios, roles y permisos, categorias, proveedores, productos, compras, ventas, movimientos de stock y reportes en PDF.

## Requisitos

- PHP 8.3 o superior
- Composer
- Node.js y npm
- SQLite, MySQL o MariaDB
- Extensiones PHP comunes para Laravel: `mbstring`, `openssl`, `pdo`, `tokenizer`, `xml`, `ctype`, `json` y `fileinfo`

## Instalacion

1. Clonar el repositorio y entrar al proyecto:

```bash
git clone <url-del-repositorio>
cd market
```

2. Instalar las dependencias de PHP:

```bash
composer install
```

3. Instalar las dependencias de frontend:

```bash
npm install
```

4. Crear el archivo de entorno:

```bash
cp .env.example .env
php artisan key:generate
```

5. Configurar la base de datos en `.env`.

Por defecto el proyecto viene preparado para SQLite:

```env
DB_CONNECTION=sqlite
```

Para usar SQLite, crear el archivo de base de datos:

```bash
touch database/database.sqlite
```

Para MySQL o MariaDB, ajustar estas variables:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=market
DB_USERNAME=root
DB_PASSWORD=
```

6. Ejecutar migraciones y seeders:

```bash
php artisan migrate --seed
```

7. Compilar assets o levantar Vite:

```bash
npm run build
```

Para desarrollo:

```bash
npm run dev
```

8. Levantar el servidor Laravel:

```bash
php artisan serve
```

La aplicacion quedara disponible normalmente en:

```text
http://127.0.0.1:8000
```

## Librerias principales

### PHP / Laravel

Estas librerias se instalan con `composer install` porque ya estan declaradas en `composer.json`:

- `laravel/framework`: framework principal.
- `laravel/tinker`: consola interactiva para Laravel.
- `barryvdh/laravel-dompdf`: generacion de reportes PDF.
- `spatie/laravel-permission`: roles y permisos.

Dependencias de desarrollo:

- `laravel/breeze`: autenticacion base.
- `laravel/pail`: visualizacion de logs en desarrollo.
- `laravel/pint`: formateador de codigo.
- `pestphp/pest` y `pestphp/pest-plugin-laravel`: pruebas automatizadas.
- `fakerphp/faker`, `mockery/mockery` y `nunomaduro/collision`: soporte para pruebas y errores en consola.

Si se esta armando el proyecto desde cero, los paquetes principales se pueden instalar con:

```bash
composer require barryvdh/laravel-dompdf spatie/laravel-permission
composer require laravel/breeze --dev
```

### JavaScript / CSS

Estas librerias se instalan con `npm install` porque ya estan declaradas en `package.json`:

- `vite`: compilacion de assets.
- `laravel-vite-plugin`: integracion de Vite con Laravel.
- `tailwindcss`, `@tailwindcss/forms`, `@tailwindcss/vite`, `postcss` y `autoprefixer`: estilos.
- `alpinejs`: interactividad ligera en vistas Blade.
- `axios`: peticiones HTTP desde JavaScript.
- `concurrently`: ejecucion paralela de procesos en desarrollo.

Si se esta armando el frontend desde cero, las librerias principales se pueden instalar con:

```bash
npm install axios
npm install -D vite laravel-vite-plugin tailwindcss @tailwindcss/forms @tailwindcss/vite postcss autoprefixer alpinejs concurrently
```

## Comandos utiles

```bash
php artisan migrate:fresh --seed
php artisan test
vendor/bin/pint
npm run build
```
