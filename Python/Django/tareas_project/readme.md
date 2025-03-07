# Tareas Project

**Tareas Project** es una aplicación web construida con Django que permite a los usuarios gestionar tareas personales. Incluye funcionalidades básicas de autenticación, creación de tareas, y una API REST para interactuar con las tareas. Este proyecto fue desarrollado como preparación para una entrevista técnica, demostrando buenas prácticas en Django, autenticación, optimización, seguridad, testing, y preparación para integrar un frontend con Vue.js.

## Características

- **Autenticación**: Registro de usuarios con login/logout y protección de vistas con `@login_required`.
- **Gestión de Tareas**:
  - Crear, listar y ver detalles de tareas mediante vistas basadas en funciones (FBV) y clases (CBV).
  - Campos: título, descripción, completada, usuario, etiquetas (ManyToMany).
- **API REST**:
  - Endpoints CRUD (`GET`, `POST`, `PUT`, `DELETE`) usando Django REST Framework (DRF).
  - Autenticación por token con `rest_framework.authtoken`.
- **Optimización**: Uso de `.select_related()` y `.prefetch_related()` para reducir consultas a la base de datos.
- **Seguridad**: Protección contra CSRF, XSS y SQL Injection gracias a las funcionalidades integradas de Django.
- **Testing**: Pruebas unitarias con `unittest` para modelos y vistas.
- **Middleware**: Middleware personalizado para registrar solicitudes (`LogRequestMiddleware`).
- **Preparado para Vue.js**: La API REST está lista para ser consumida por un frontend en Vue.js.

## Requisitos

- Python 3.12 o superior
- Django 5.1.6
- Django REST Framework
- Un entorno virtual (recomendado)
- Postman (para probar la API)

## Instalación

Sigue estos pasos para configurar el proyecto localmente:

1. **Clona el repositorio:**
    ```bash
    git clone <URL_DEL_REPOSITORIO>
    cd tareas_project
    ```

2. **Crea y activa un entorno virtual:**
    ```bash
    python -m venv venv
    source venv/bin/activate  # En Windows: venv\Scripts\activate
    ```
3. **Instala las dependencias:**
    ```bash
    pip install -r requirements.txt
    ```

4. **Configura la base de datos:**
   - El proyecto usa SQLite por defecto (db.sqlite3). Si deseas usar otra base de datos (como PostgreSQL), ajusta DATABASES en tareas_project/settings.py.

5. **Aplica las migraciones para crear las tablas:**
    ```bash
    python manage.py migrate
    ```

6. **Crea un superusuario (para acceder al admin y probar la autenticación):**
    ```bash
    python manage.py createsuperuser
    ```
    Sigue las instrucciones para crear un usuario (por ejemplo, admin/1234).

7. **Inicia el servidor:**
    ```bash
    python manage.py runserver
    ```
   - Accede a http://127.0.0.1:8000/tareas/ para ver la lista de tareas.
   - Usa http://127.0.0.1:8000/admin/ para acceder al panel de administración.

## Uso

### Funcionalidades Principales
- Lista de Tareas: Visita http://127.0.0.1:8000/tareas/ para ver todas las tareas.

- Crear Tareas: Usa http://127.0.0.1:8000/tareas/crear/ (requiere autenticación).

- Detalles de Tarea: Accede a http://127.0.0.1:8000/tareas/detalle/<id>/ para ver una tarea específica.

- API REST:
  - Obtener Token: Usa POST /tareas/api-token-auth/ con {"username": "admin", "password": "1234"}.
  
  - Endpoints CRUD:
    - GET /tareas/api/tareas/: Lista todas las tareas.
    - POST /tareas/api/tareas/: Crea una tarea.
    - PUT /tareas/api/tareas/<id>/: Actualiza una tarea.
    - DELETE /tareas/api/tareas/<id>/: Elimina una tarea.
  
  - Usa un header Authorization: Token <tu-token> para autenticar las solicitudes.


## Estructura del Proyecto
    tareas_project/
    ├── tareas/
    │   ├── migrations/        # Migraciones de la base de datos
    │   ├── templates/         # Templates HTML
    │   │   ├── tareas/
    │   │       ├── tarea_lista.html
    │   │       ├── tarea_detail.html
    │   │       ├── tarea_form.html
    │   │       ├── login.html
    │   ├── __init__.py
    │   ├── admin.py           # Configuración del panel de administración
    │   ├── apps.py            # Configuración de la app
    │   ├── middleware.py      # Middleware personalizado
    │   ├── models.py          # Modelos Tarea y Etiqueta
    │   ├── serializers.py     # Serializers para DRF
    │   ├── tests.py           # Pruebas unitarias
    │   ├── urls.py            # Rutas de la app
    │   ├── views.py           # Vistas (FBV y CBV)
    ├── tareas_project/
    │   ├── __init__.py
    │   ├── settings.py        # Configuración del proyecto
    │   ├── urls.py            # Rutas principales
    │   ├── wsgi.py            # Configuración para WSGI
    ├── .gitignore             # Ignora archivos innecesarios
    ├── manage.py              # Script de gestión de Django
    └── README.md              # Documentación del proyecto

## Pruebas
El proyecto incluye pruebas unitarias para modelos y vistas. 
Para ejecutarlas:
```bash
python manage.py test
```
- Pruebas actuales:
  - test_tarea_creation: Verifica la creación de un modelo Tarea.
  
  - test_tarea_lista_view: Comprueba que la vista de lista de tareas devuelva un 200.
  
  - test_tarea_crear_view: Valida que la creación de una tarea redirija correctamente.

## Optimización y Seguridad
- Optimización: Uso de .select_related('usuario') y .prefetch_related('etiquetas') para minimizar consultas a la base de datos.

- Seguridad:
  - Protección contra CSRF con {% csrf_token %} en formularios.

  - Prevención de XSS y SQL Injection mediante el ORM y escape automático de Django.

  - Autenticación requerida para acciones sensibles (crear tareas, API).

## Contribuir
- Forkea el repositorio.

- Crea una nueva rama (git checkout -b feature/nueva-funcionalidad).

- Realiza tus cambios y haz commit (git commit -m "Añadir nueva funcionalidad").

- Haz push a tu rama (git push origin feature/nueva-funcionalidad).

- Crea un Pull Request.

## Posibles Mejoras
- Agregar vistas para editar y eliminar tareas (UpdateView, DeleteView).

- Implementar filtros en la API con DRF.

- Integrar un frontend con Vue.js para consumir la API.

- Añadir más pruebas unitarias (para la API, middleware, etc.).

## Licencia
Este proyecto está bajo la Licencia MIT (pendiente de incluir archivo LICENSE).

## Autor
- Marcelo Duhalde

