# Challenge Yii2 - Gestión de Usuarios

Este proyecto es una solución al desafío técnico planteado por **Possumus**, desarrollado en el framework **Yii2** con una base de datos **MySQL**. El objetivo del desafío es implementar un sistema básico de gestión de usuarios mediante una API RESTful, incluyendo endpoints para registrar, listar, buscar, actualizar y eliminar usuarios, con validaciones adecuadas para casos de éxito y error.

## Requisitos del Desafío

1. **Registro de usuarios**: Endpoint para registrar usuarios mayores de 18 años con los campos obligatorios: nombre, apellido, edad, email y DNI.
2. **Listado de usuarios**: Dos endpoints, uno para listar todos los usuarios y otro para buscar un usuario por DNI.
3. **Actualización de usuarios**: Endpoint para actualizar los datos de un usuario filtrado por DNI.
4. **Eliminación de usuarios**: Endpoint para eliminar un usuario por DNI.
5. **Validaciones**: Manejo de casos de éxito y error (ejemplo: "Usuario no encontrado", "El usuario no pudo ser creado").

## Tecnologías Utilizadas

- **Framework**: Yii2
- **Base de datos**: MySQL
- **Gestión de tablas**: Migrations de Yii2
- **API**: RESTful con verbos HTTP (GET, POST, PUT, DELETE)

## Estructura del Proyecto

- **`controllers/UsuariosController.php`**: Controlador REST que implementa los endpoints solicitados.
- **`models/Usuario.php`**: Modelo ActiveRecord para la tabla `usuarios`, con reglas de validación.
- **`migrations/m220527_190621_create_table_usuario.php`**: Migración para crear la tabla `usuarios` en la base de datos.

## Instalación

1. **Clonar el repositorio:**
    ```bash
    git clone <URL_DEL_REPOSITORIO>
    cd <NOMBRE_DEL_PROYECTO>
    ``` 
2. **Instalar dependencias:**
Asegúrate de tener Composer instalado y ejecuta:
    ```bash
    composer install
    ```
3. **Configurar la base de datos:**
- Crea una base de datos en MySQL (ejemplo: challenge_yii2).

- Edita el archivo config/db.php con tus credenciales:
    ```bash
    return [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=localhost;dbname=challenge_yii2',
        'username' => 'tu_usuario',
        'password' => 'tu_contraseña',
        'charset' => 'utf8',
    ];
    ```
4. **Ejecutar migraciones:**
Aplica la migración para crear la tabla usuarios:
    ```bash
    php yii migrate
    ```
5. **Iniciar el servidor:**
Usa el servidor integrado de Yii2:
    ```bash
    php yii serve
    ```
El proyecto estará disponible en http://localhost:8080.

## Endpoints de la API
### 1. Registro de Usuarios
- Método: POST

- Ruta: /usuarios/insertar

- Cuerpo de la solicitud:
    ```bash
    {
        "nombre": "Juan",
        "apellido": "Pérez",
        "edad": 25,
        "email": "juan.perez@example.com",
        "dni": 12345678
    }
    ```
- Respuesta exitosa (200):
    ```bash
    {"exito": "el usuario ha sido ingresado exitosamente."}
    ```

- Error (400):
  - Edad menor a 18: {"error": "el usuario ingresado debe ser mayor de 18 años de edad."}

  - Campos inválidos: {"error": "ocurrió un error al guardar, por favor verifique los campos ingresados."}

### 2. Listado Completo de Usuarios
- Método: GET

- Ruta: /usuarios/listado

- Respuesta exitosa (200):
    ```bash
    [
        {"id": 1, "nombre": "Juan", "apellido": "Pérez", "edad": 25, "email": "juan.perez@example.com", "dni": 12345678},
        {"id": 2, "nombre": "María", "apellido": "Gómez", "edad": 30, "email": "maria.gomez@example.com", "dni": 87654321}
    ]
    ```
### 3. Búsqueda de Usuario por DNI
- Método: GET

- Ruta: /usuarios/listado-filtrado?dni=12345678

- Respuesta exitosa (200):
    ```bash
    {"exito": {"id": 1, "nombre": "Juan", "apellido": "Pérez", "edad": 25, "email": "juan.perez@example.com", "dni": 12345678}}
    ```
- Error (400):
    ```bash
    {"error": "Usuario no encontrado."}
    ```
### 4. Actualización de Usuario
- Método: PUT

- Ruta: /usuarios/actualizar?dni=12345678

- Cuerpo de la solicitud:
    ```bash
    {
        "nombre": "Juan Carlos",
        "apellido": "Pérez",
        "edad": 26,
        "email": "juancarlos.perez@example.com",
        "dni": 12345678
    }
    ```
- Respuesta exitosa (200):
    ```bash
    {"exito": "el usuario ha sido actualizado exitosamente."}
    ```
- Error (400):
  - No encontrado: 
    ```bash
    {"error": "Usuario no encontrado."}
    ```
  - Campos inválidos:
    ```bash
    {"error": "ocurrió un error al guardar, por favor verifique los campos ingresados."}
    ```

### 5. Eliminación de Usuario
- Método: DELETE

- Ruta: /usuarios/eliminar?dni=12345678

- Respuesta exitosa (200):
    ```bash
    {"exito": "el usuario ha sido eliminado exitosamente."}
    ```
- Error (400):
    ```bash
    {"error": "Usuario no encontrado."}
    ```
## Notas Adicionales
- Validaciones: Se implementaron validaciones para la edad (mayor a 18), campos obligatorios y existencia del usuario en las operaciones de búsqueda, actualización y eliminación.

- Códigos de estado: Se utilizan códigos HTTP 200 para éxito y 400 para errores.

- Migraciones: La tabla usuarios se crea mediante una migración, asegurando portabilidad y control de versiones en la base de datos.

## Entrega
El proyecto fue desarrollado en un tiempo estimado de 24 horas y subido a un repositorio en [Bitbucket/GitHub] (rama específica: challenge, mergeada a main).
