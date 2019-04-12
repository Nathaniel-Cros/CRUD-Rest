# CRUD-Rest
Proyecto con base en Slim/Skeleton para realizar api´s para altas bajas y cambios en una base de datos. 

## Instalación 
Vemos que el Framework Slim 3, al igual que este proyecto, trabaja bajo ciertos requerimientos los cuales son necesarios para un correcto funcionamineto.
 
 **Lista de los requisistos para este proyecto son:**

    ·PHP 5.5.0 o superior
    ·Composer
    ·Conexión a Internet
 
 Una vez descargado el proyecto hay que posicionarnos en la carpeta desde el bash (linea de comandos), y ejecutar el comando
 
    > Composer install
    
 Con esto instalamos todas las dependencias y hace las configuraciones aplicadas en el archivo **composer.json** y con esta configuración podemos ejecutar el comando:
 
    > Composer start
    
  o el comando:
  
    > php -S localhost:8080 -t public
  
 Con uno de esos comando activamos un pequeño servidor local el cual nos permitira interacturar con el Api Rest programado.
 
 
 ## Rutas y Consumo de Api´s
 
 En esta sección se describe las rutas de acceso, el uso adecuado y respuesta de la aplicacion web.
 
 ### Obtener todos los usuarios
 
    localhost:8080/user/allusers
 
Esta ruta es de tipo **GET**, no recibe ningun dato, y nos devuelve un **JSON** con todos los usuarios en nuestra base de datos.
    
````json
[
        {
            "id": "1",
            "nombre": "Oscar Nathaniel Ruiz Perez",
            "telefono": "5546959000",
            "direccion": "Emiliano Zapara No 33",
            "email": "oscnathanielrp@gmail.com",
            "username": "NathanielCros",
            "pass": "ouiouoiuooiuoiu"
        },
        {
            "id": "2",
            "nombre": "Oscar Nathaniel Ruiz Perez",
            "telefono": "5546959000",
            "direccion": "Emiliano Zapara No 33",
            "email": "oscnathanielrp@gmail.com",
            "username": "NathanielCros",
            "pass": "918ca9fcc6da521f876bb8beaxs87gkljlkjlk"
        },
        {
            "id": "3",
            "nombre": "Oscar Nathaniel Ruiz Perez",
            "telefono": "5546959000",
            "direccion": "Emiliano Zapara No 33",
            "email": "oscnathanielrp@gmail.com",
            "username": "NathanielCros",
            "pass": "kljlkjlc17b672f36d755ac2331bkljwet7news"
        }
    ]
````

### Obtener un Usuario

    localhost:8080/user/{id}

Esta ruta es de tipo **GET**, recibe un Atributo en la URL, Sustituir **{id}** por un id de algún usuario, el resultado sera la información de ese unico usuario.
````json
    [
        {
            "id": "3",
            "nombre": "Oscar Nathaniel Ruiz Perez",
            "telefono": "5546959000",
            "direccion": "Emiliano Zapara No 33",
            "email": "oscnathanielrp@gmail.com",
            "username": "NathanielCros",
            "pass": "kljlkjlc17b672f36d755ac2331bkljwet7news"
        }
    ] 
````

### Crear un Usuario

    localhost:8080/user/New

Esta ruta es de tipo **POST**, recibe parametros, en este caso un **JSON** con los datos del nuevo usuario, lo que regresa es un mensaje de que se agrego correctamente o muestra un mensaje de error al agregar usuario.

Respuesta de agregado corectamente:

````json
    {
        "mensaje":"Usuario agregado"
    }
````

En caso de no ser agregado corectamente:

````json
    {
        "mensaje":"Error al agregar usuario"
    }
````

### Modificación de un Usuario

    localhost:8080/user/Update/{id}
    
Esta ruta es de tipo **PUT**, recibe un atributo, sustituir **{id}** por un id de algún usuario, y varios parametros, en este caso un **JSON** con los datos nuevos para un usuario con el id que se proporcione, lo que regresa es un mensaje de que se agrego correctamente o muestra un mensaje de error al actualizar al usuario.

Respuesta de actualización corecta:

````json
    [
        {
            "mensaje":"Usuario con id {id}: Modificado Correctamente!"
        }
    ]
````
En caso de no ser actualizado corectamente:

````json
    [
        {
            "mensaje":"Usuario con id {id}: No Modificado!"
        }
    ]
````

### Borrar a un usuario
    
    localhost:8080/user/Update/{id}

Esta ruta de tipo **DELETE**, recibe un atributo, sustituir **{id}** por algún id de un usuario, y nos regresa un mensaje que fue borrado correctamente o un un mensjade de error.

Respuesta de borrado corectamente:

````json
    [
        {
            "mensaje":"Usuario con id {id}: Borrado Correctamente!"
        }
    ]
````
En caso de no ser borrado corectamente:

````json
    [
        {
            "mensaje":"Usuario con id {id}: No Borrado!"
        }
    ]
````

### Login de un Usuario

    localhost:8080/user/Login

Esta ruta de tipo **POST**, recibe dos parametros, recibe el email o username y la contraseña. El resultado si es un match en la consulta regresa un token dentro de un objeto **JSON**.

Respuesta de login correcto:
````json
{
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpYXQiOjE1NTUwMjYyMTUsImV4cCI6MTU1NTExMjYxNSwidXNlciI6eyJpZCI6IjUiLCJub21icmUiOiJPc2NhciBOYXRoYW5pZWwgUnVpeiBQZXJleiIsInRlbGVmb25vIjoiNTU0Njk1OTAwMCIsImRpcmVjY2lvbiI6IkVtaWxpYW5vIFphcGFyYSBObyAzMyIsImVtYWlsIjoib3NjbmF0aGFuaWVscnBAZ21haWwuY29tIiwidXNlcm5hbWUiOiJOYXRoYW5pZWxDcm9zIiwicGFzcyI6ImMxN2I2NzJmMzZkNzU1YWMyMzMxYjliMmYyMjY1MWI5In19.a6bOq8es3nT3kF8BR0vlUwBlrCa2jG6YfQAsShGgbgogtQF-XfvQIu4rXNr5DX89xllQ5YuTXaDcOV_slgJv1w"
}
````
En caso de un login incorrecto:
````json
[
  {
    "mensaje":"Rectifica tus datos",
  }
]
````