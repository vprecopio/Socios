# Entorno Docker PHP + MySQL + phpMyAdmin + PHPMailer

## Servicios incluidos

- PHP 8.2 con Apache
- MySQL 8.0
- phpMyAdmin (en puerto 8061)
- PHPMailer (instalado en `src/libs/PHPMailer`)

## Puertos

| Servicio     | Puerto |
|--------------|--------|
| Web (PHP)    | 8062   |
| MySQL        | 8060   |
| phpMyAdmin   | 8061   |

## Pasos para levantar el entorno

1. Clonar o copiar el proyecto
2. Modificar `.env` si es necesario
3. Ejecutar en terminal:

```bash
sudo docker compose up --build -d
```

4. Acceder a:

- Proyecto: [http://localhost:8062](http://localhost:8062)
- phpMyAdmin: [http://localhost:8061](http://localhost:8061)
  - Usuario: `usuario`
  - Contraseña: `clave`

## Apagar los contenedores

```bash
sudo docker compose down
```

## PHPMailer

Ya viene instalado dentro del contenedor. Podés usarlo desde:

```php
require_once __DIR__ . '/libs/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/libs/PHPMailer/src/SMTP.php';
require_once __DIR__ . '/libs/PHPMailer/src/Exception.php';
```
## Ingreso vista admin
usuario: admin
contraseña: admin