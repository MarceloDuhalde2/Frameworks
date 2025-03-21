# Player Team Generator Web API

## Descripción del Proyecto

Este proyecto es una API RESTful desarrollada en **Laravel 9.14.1** con **PHP 8.1.32**, diseñada para gestionar jugadores y generar equipos basados en requisitos específicos. La API permite listar, crear, actualizar y eliminar jugadores, así como procesar equipos seleccionando los mejores jugadores según su posición y habilidad principal. La base de datos utilizada es **SQLite**, y el proyecto incluye pruebas funcionales para verificar el comportamiento de los endpoints.

El proyecto fue desarrollado como parte de un desafío técnico, cumpliendo con las restricciones de no modificar `composer.json`, `composer.lock`, ni la estructura de la base de datos (`database/database.sqlite`).

---

## Requisitos

- **PHP**: 8.1.32
- **Laravel**: 9.14.1
- **Base de datos**: SQLite (incluida en `database/database.sqlite`)
- **Composer**: Para instalar dependencias (aunque no se modificaron en este proyecto)

---

## Instalación

1. **Clona el repositorio** (si aplica):
    ```bash
    git clone <url-del-repositorio>
    cd player-team-generator-web-api
    ```
2. **Instala las dependencias (ya incluidas, pero verifica):**
    ```bash
    composer install
    ```
3. **Configura el entorno:**
- El archivo .env ya está configurado para usar SQLite (database/database.sqlite).

- No se requieren migraciones ni seeds, ya que el desafío prohíbe modificar la estructura de la base de datos.

4. **Inicia el servidor:**
    ```bash
    php artisan serve --port=3000
    ```
La API estará disponible en http://localhost:3000.

## Endpoints de la API
La API ofrece los siguientes endpoints:
### 1. Listar todos los jugadores
- Método: GET

- URL: /api/player

- Respuesta: Código 200 con una lista de jugadores en formato JSON.
    ```json

    [
        {
            "id": 1,
            "name": "Player1",
            "position": "midfielder",
            "playerSkills": [
                {"skill": "speed", "value": 80},
                {"skill": "attack", "value": 60}
            ]
        }
    ]
    ```
### 2. Crear un nuevo jugador
- Método: POST

- URL: /api/player

- Cuerpo (JSON):
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
- Respuesta: Código 201 con el jugador creado.

### 3. Actualizar un jugador existente
- Método: PUT

- URL: /api/player/{id}

- Cuerpo (JSON):
    ```json

    {
        "name": "Player1 Updated",
        "position": "forward",
        "playerSkills": [
            {"skill": "strength", "value": 90}
        ]
    }
    ```
- Respuesta: Código 200 con el jugador actualizado.

### 4. Eliminar un jugador
- Método: DELETE

- URL: /api/player/{id}

- Encabezado: Authorization: Bearer SkFabTZibXE1aE14ckpQUUxHc2dnQ2RzdlFRTTM2NFE2cGI4d3RQNjZmdEFITmdBQkE=

- Respuesta:
  - Código 204 (sin contenido) si el token es válido.

  - Código 401 ({"message": "Unauthorized"}) si el token no es válido o no se envía.

### 5. Procesar un equipo
- Método: POST

- URL: /api/team/process

- Cuerpo (JSON):
    ```json

    [
        {
            "position": "midfielder",
            "mainSkill": "speed",
            "numberOfPlayers": 1
        },
        {
            "position": "defender",
            "mainSkill": "strength",
            "numberOfPlayers": 1
        }
    ]
    ```
- Respuesta: Código 200 con la lista de jugadores seleccionados:
    ```json

    [
        {
            "name": "Player1",
            "position": "midfielder",
            "playerSkills": [
                {"skill": "speed", "value": 80},
                {"skill": "attack", "value": 60}
            ]
        },
        {
            "name": "Player2",
            "position": "defender",
            "playerSkills": [
                {"skill": "strength", "value": 90},
                {"skill": "defense", "value": 70}
            ]
        }
    ]
    ```
## Pruebas
El proyecto incluye pruebas funcionales en el directorio tests/Feature/. Estas pruebas verifican el comportamiento de los endpoints.
### Ejecutar las pruebas
1. **Asegúrate de que el servidor no esté corriendo (para evitar conflictos de puerto).**

2. **Ejecuta las pruebas con:**
    ```bash
    php artisan test
    ```
3. **Resultado esperado:**
    ```
    PASS  Tests\Unit\ExampleTest
    ✓ that true is true

    PASS  Tests\Feature\PlayerControllerCreateTest
    ✓ sample
    ✓ test_create_player_returns_201

    PASS  Tests\Feature\PlayerControllerDeleteTest
    ✓ sample
    ✓ test_delete_player_returns_401_without_token_and_204_with_valid_token

    PASS  Tests\Feature\PlayerControllerListingTest
    ✓ sample
    ✓ test_get_players_returns_list_with_correct_structure

    PASS  Tests\Feature\PlayerControllerUpdateTest
    ✓ sample
    ✓ test_update_player_returns_200

    PASS  Tests\Feature\TeamControllerTest
    ✓ sample
    ✓ test_process_team_returns_200

    Tests:  11 passed
    Time:   X.XXs
    ```
## Notas Adicionales
- Base de datos: No se modificó la estructura de database/database.sqlite, cumpliendo con las restricciones del desafío. Los datos creados manualmente con Postman persisten hasta que se reinicie la base de datos (e.g., al ejecutar pruebas con RefreshDatabase).

- Errores en processTeam: El método processTeam tiene problemas de escalabilidad y manejo de errores que podrían mejorarse (e.g., agregar índices a la base de datos, manejar casos donde no hay habilidades).

- Depuración: Para depurar errores, revisa los logs en storage/logs/laravel.log o usa dd() en el código.

## Estructura del Proyecto
- app/Http/Controllers/PlayerController.php: Controlador principal con la lógica de los endpoints.

- app/Http/Middleware/CheckBearerToken.php: Middleware para autenticación con token Bearer.

- app/Models/Player.php: Modelo para jugadores.

- app/Models/PlayerSkill.php: Modelo para habilidades de jugadores.

- routes/api.php: Definición de rutas de la API.

- tests/Feature/: Pruebas funcionales para los endpoints.

## Autor
Marcelo Duhalde

## Licencia
Este proyecto no especifica una licencia, ya que fue desarrollado para un desafío técnico. Todos los derechos están reservados según las instrucciones del desafío.

