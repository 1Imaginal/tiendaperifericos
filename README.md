Versión actual: v1.0.0

# Tienda de Periféricos

Un sistema de comercio electrónico web especializado en la venta de periféricos de computadora (mouses, teclados y mousepads). Desarrollado con PHP y MariaDB, y completamente contenedorizado con Docker para facilitar su despliegue en cualquier entorno.

##  Características Principales

* **Arquitectura Dockerizada:** Entorno listo para producción con contenedores separados para la aplicación web (Apache / PHP 8.2) y la base de datos (MariaDB 10.11).
* **Base de Datos Normalizada:** Estructura relacional optimizada con tablas específicas para fabricantes, categorías y especificaciones técnicas por tipo de periférico.
* **Seguridad y Autenticación:** 
  * Contraseñas cifradas con **Bcrypt** (`password_hash` / `password_verify`).
  * Control de sesiones robusto y protección contra ejecución prematura de cabeceras (`headers already sent`).
* **Gestión de Carrito y Pedidos:**
  * Añadir, actualizar unidades y eliminar productos del carrito de compras.
  * Validación en tiempo real de stock disponible en inventario.
  * Transacción automatizada al realizar el pedido: generación de registro en historial de compras, descuento automático de stock y limpieza de carrito.
* **Panel de Administración:** Gestión completa para insertar, actualizar y eliminar productos y fabricantes.

##  Tecnologías Utilizadas

* **Backend:** PHP 8.2 (con extensiones MySQLi).
* **Base de Datos:** MariaDB 10.11.
* **Servidor Web:** Apache
* **Despliegue:** Docker & Docker Compose
* **Frontend:** Bootstrap 5.3, HTML5, CSS3, JavaScript.

##  Estructura de la Base de Datos

El sistema utiliza un esquema altamente relacional para evitar la redundancia de datos:
* **Entidades Base:** `usuarios`, `compras`, `carrito`.
* **Catálogo:** `productos`, `fabricante`, `categorias`, `objetos`.
* **Especificaciones (Sub-tablas):** `mouse`, `teclado`, `mousepad`.

##  Instalación y Despliegue (Docker)

La forma más sencilla de levantar el proyecto es utilizando Docker. No es necesario instalar PHP ni MariaDB en tu máquina local.


1. **Clonar el repositorio:**
   ```bash
   git clone <URL_DE_TU_REPOSITORIO>
   cd tiendaperifericos
   ```

2. **Levantar los contenedores**
    Ejecuta el siguiente comando en la raíz del proyecto. Esto descargará las imágenes necesarias, construirá el servidor web y ejecutará el script db.sql automáticamente.
    ```bash
    docker compose up --build -d
    ```
3. **Inyectar la base de datos y el seed**
    El contenedor de MariaDB inicializará la estructura. Puedes poblar los datos iniciales (usuarios con contraseña cifrada, fabricantes, productos con descripciones y especificaciones) ejecutando:
    ```bash
    docker compose exec -T db mariadb -u root -padmin_perifericos tienda_perifericos < seed.sql
    ```

3. **Acceder a la aplicacion**I
    Abre tu navegador web y navega a:
    http://localhost:8080

## Credenciales y Variables de Entorno
Por defecto, la base de datos de Docker se configura con las siguientes variables (definidas en el docker-compose.yml):

* **Host:** db
* **Puerto Externo:** 3307
* **Base de Datos:** tienda_perifericos

**Credenciales de Prueba (Seed)**
El sistema incluye cuentas precargadas para pruebas:

* **admin**
Contraseña: admin123

* **test-user-1**
Contraseña: test1234

* **test-user-2**
Contraseña: test1234


## Gestión de Archivos
Las imágenes de los productos subidas desde el panel de administrador se guardan automáticamente en la ruta /rsc/productos/. El Dockerfile se encarga de asignar los permisos www-data correctos para que Apache pueda escribir en este directorio sin problemas de acceso.