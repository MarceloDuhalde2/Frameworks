# Player API - Laravel Challenge

Este proyecto es una API RESTful desarrollada en Laravel 12 como solución a un desafío técnico. La API permite gestionar jugadores (crear, listar, actualizar, eliminar) y seleccionar los mejores jugadores según posición y habilidades específicas.

## Requisitos
- **PHP**: 8.2 o superior
- **Composer**: Última versión
- **SQLite**: Usado como base de datos (no requiere servidor externo)
- **Postman**: Para probar los endpoints (opcional)

## Instalación

1. **Clonar el proyecto (si aplica):**
    Si este proyecto está en un repositorio, clónalo:
    ```bash
    git clone <url-del-repositorio>
    cd player-api
    ```
2. **Instalar dependencias:**
    ```bash
    composer install
    ```

3. **Configurar el entorno:**
   - Copia el archivo de ejemplo .env:
    ```bash
    cp .env.example .env
    ```

   - Edita .env para usar SQLite:**
    ```bash
    DB_CONNECTION=sqlite
    DB_DATABASE=/var/www/html/github/Portfolio Marcelo Duhalde/Frameworks/PHP/Laravel/player-api/database/database.sqlite
    ```
   
   - Crea el archivo SQLite si no existe:
    ```bash
    touch database/database.sqlite
    ```

4. **Generar la clave de la aplicación:**
    ```bash
    php artisan key:generate
    ```

5. **Aplicar migraciones:**
    Crea las tablas en la base de datos:
    ```bash
    php artisan migrate
    ```

## Uso

### Iniciar el servidor
Ejecuta el servidor local en el puerto 3000 (como requiere el desafío):
    ```bash
    php artisan serve --port=3000
    ```
La API estará disponible en http://localhost:3000/api/.

### Endpoints
| Método | Endpoint                | Descripción                     | Autenticación          |
|--------|-------------------------|---------------------------------|------------------------|
| GET    | /api/player             | Lista todos los jugadores       | Ninguna                |
| POST   | /api/player             | Crea un nuevo jugador           | Ninguna                |
| PUT    | /api/player/{id}        | Actualiza un jugador            | Ninguna                |
| DELETE | /api/player/{id}        | Elimina un jugador              | Token Bearer requerido |
| POST   | /api/team/process       | Selecciona los mejores jugadores| Ninguna                |

Ejemplo de cuerpo para POST /api/player
```json
{
    "name": "Player1",
    "position": "midfielder",
    "playerSkills": [
        {"skill": "speed", "value": 80},
        {"skill": "attack", "value": 60}
    ]
}
```

Token Bearer para DELETE
Usa este token en el encabezado Authorization:
```
Bearer SkFabTZibXE1aE14ckpQUUxHc2dnQ2RzdlFRTTM2NFE2cGI4d3RQNjZmdEFITmdBQkE=
```

Ejemplo de cuerpo para POST /api/team/process
```json

[
    {"position": "midfielder", "mainSkill": "speed", "numberOfPlayers": 1},
    {"position": "defender", "mainSkill": "strength", "numberOfPlayers": 2}
]
```

## Probar los endpoints
Usa Postman o curl para interactuar con la API. Ejemplo con curl:
```bash
curl -X POST http://localhost:3000/api/player -H "Content-Type: application/json" -d '{"name":"Player1","position":"midfielder","playerSkills":[{"skill":"speed","value":80}]}'
```
## Pruebas
El proyecto incluye pruebas unitarias y funcionales en tests/Feature/PlayerTest.php. Para ejecutarlas:
```bash
php artisan test
```
Las pruebas cubren:
- Creación de un jugador (POST /api/player)

- Listado de jugadores (GET /api/player)

- Actualización de un jugador (PUT /api/player/{id})

- Eliminación de un jugador (DELETE /api/player/{id})

- Selección de equipo (POST /api/team/process)

## Estructura del proyecto
  - app/Http/Controllers/Api/PlayerController.php: Controlador principal de la API.

  - app/Models/: Modelos Player y PlayerSkill.

  - app/Http/Middleware/CheckBearerToken.php: Middleware para autenticación del DELETE.

  - routes/api.php: Definición de rutas API.

  - bootstrap/app.php: Configuración de rutas, middlewares y excepciones.

  - database/migrations/: Migraciones para las tablas players y player_skills.

  - tests/Feature/PlayerTest.php: Pruebas funcionales.

## Notas importantes
- Este proyecto sigue las instrucciones del desafío: no se modificaron archivos preexistentes ni su estructura.

- Las respuestas de error siguen el formato {"message": "Invalid value for field: value"}.

- La base de datos SQLite se reinicia con cada ejecución de pruebas gracias a RefreshDatabase.

## Autor
Marcelo Duhalde - Proyecto local para desafío técnico en Laravel.

