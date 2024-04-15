
# Proyecto Prueba2024

Este proyecto contiene una estructura de carpetas y archivos para el desarrollo de una aplicación con Docker. Utiliza XAMPP como servidor local y Docker para contener los servicios necesarios.

## Estructura de Carpetas

- **app/**: Contiene la lógica de la aplicación.
  - **Config/**: Archivos de configuración de la aplicación.
  - **Controllers/**: Controladores de la lógica de la aplicación.
  - **Models/**: Modelos de datos de la aplicación.
  - **Html/**: Archivos HTML de la aplicación.
  - **Repositories/**: Repositorios de datos de la aplicación.
  - **test/**: Archivos de prueba de la aplicación.
  - **views/**: Vistas de la aplicación.

## Archivos Principales

- **Dockerfile**: Archivo para instalar los recursos en el contenedor.
- **docker-compose.yml**: Estructura del contenedor con Apache y MySQL, incluyendo la creación de la base de datos y tablas necesarias.
- **docker.sh**: Script para crear la imagen y desplegar Docker.

## Configuración Local

- Descarga el repositorio dentro de la carpeta `C:/prueba2024`.
- Para crear los contenedores de Apache, MySQL, la base de datos y las tablas existentes, ejecuta el siguiente comando:
  ```
  sh Docker.sh
  ```

## APIs para Probar desde Postman
**Nota**: Para probar las APIs una vez creadas en el Contenedor, debes quitar "prueba2024" de la URL.

### Listar Todos los Usuarios
- Método: GET
- URL: http://localhost/prueba2024/app/index.php/user/getAll

### Mostrar los Datos de un Usuario
- Método: GET
- URL: http://localhost/prueba2024/app/index.php/user/getUser

### Mostrar el Saldo de un Usuario
- Método: POST
- URL: http://localhost/app/index.php/wallet/getBalance
- Request:
  ```json
  {
      "user_id": 1
  }
  ```
- Response:
  ```json
  {
      "id": 1,
      "user_id": 1,
      "balance": 5000
  }
  ```

### Realizar una Transferencia
- Método: POST
- URL: http://localhost/prueba2024/app/index.php/transaction/createTransaction
- Request:
  ```json
  {
      "value": 100.0,
      "payer": 1,
      "payee": 2
  }
  ```
- Response:
  ```json
  {
      "transaction_id": 46,
      "userPayerId": 1,
      "notification": true
  }
  ```
