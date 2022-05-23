Manual de despliegue.
--------------------
Aplicación de prueba para Nexura Internacional

Alcance.
--------
Esta prueba consta de un formulario de empleados el cual se asocia con otras entidades que permiten el detalle de los colaboradores como sus roles y sus áreas asignadas.

Arquitectura general.
---------------------
El desarrollo esta propuesto en el framework laravel versión 8, con el cual se agiliza la implementación de funcionalidades por medio de paquetes, esta modalidad permite la separación de capas y por lo tanto la gestión de buenas practicas en programación OO. El motor de Base de datos es My Sql y para su gestión local se uso la herramienta Xampp (PHP, MYsql y Apache server) en el entorno windows 10, así como las herramientas del node.js y composer como gestor de paquetes.


Herramientas necesarias.
------------------------
node.ja
composer (Gestor de paquetes)
apache server 
php 7
MySql (Motor de BD)


A considerar.
-------------
El modelo de datos propuesto es alterado a nivel de nomenclatura plural ya que el framework Laravel depende de este factor para la asociación de entidades.


Despliegue de aplicativo.
-------------------------

Una vez validado el correcto funcionamiento de las herramientas, se debe proceder con:
1. ubicar el folder de nombre "nexura-app" en la carpeta raíz del servidor o dende se configuro su interprete (apache server).

2. Verificar que los permisos de la carpeta (escritura), las dependencias del Composer, la creación de una nueva API key y la configuración de la base de datos en el archivo .env, se ejecuten correctamente dentro del folder "nexura-app".

3. Según el diccionario de datos planteado, existen los archivos de migración a la base de  datos con la estructura con la que se genera el script SQL.
Los archivos están ubicados en la carpeta databases->migrations

php artisan make:migration (entidades en orden lógico)
areas
roles
empleados
empleado_roles
 (Ya se crearon estos archivos)

4. Los archivos creados de migraciones deben ser ejecutados en un orden lógico para su asociación correcta de entidades (estos se ejecutan en el orden de tiempo).
Ejecutar el comando "php artisan migrate".

El sistema en consola debe mostrar la ejecución correcta de las entidades en la BD.

5. Se integra el paquete de gestión para usuarios (GUI) de laravel con el comando
"composer require laravel/ui"

6. instalar el componente boostrap con autenticación.
"php artisan ui bootstrap --auth"

7. Compilar los comandos para paquetes de node e integración.
"npm install" y posteriormente "npm run dev"

8. El crud se genera de forma ágil con el paquete ibex, el cual se instala con el comando.
"composer require ibex/crud-generator --dev"

9. Una vez instalado, ejecutar el comando "php artisan vendor:publish --tag=crud" este tag permite invocar el comando para generar los crud necesarios de las entidades.

10. Crear los crud de las entidades (estos archivos ya existen en el juego de carpetas).
"php artisan make:crud areas"
...
"php artisan make:crud roles"
...
"php artisan make:crud empleados"
...
"php artisan make:crud empleado_roles"
...


11. Las rutas están configuradas en el archivo web.php dentro de la carpeta "routes".

Nota.
-----
Es importante tener en cuenta tanto la limpieza de vistas y cache del juego de carpetas una vez se translade, al igual que la posible nueva API key del archivo .env

