# Refugio

Este proyecto de Django es un sistema de gestión para un refugio de mascotas, diseñado para manejar adopciones, mascotas y usuarios. Incluye aplicaciones para registrar solicitudes de adopción (`adopcion`), administrar información de mascotas (`mascota`), y gestionar cuentas de usuarios (`usuario`). Utiliza una base de datos SQLite y cuenta con un sistema de autenticación y recuperación de contraseñas.

## Requisitos
- Python 3.12 (o compatible)
- Django (instalado en un entorno virtual recomendado)

## Instalación

1. **Clona el repositorio (si está alojado en Git):**
    ```bash
    git clone https://github.com/tu_usuario/refugio.git
    cd refugio
    ```

2. **Crea y activa un entorno virtual:**
    ```bash
    python3 -m venv venv
    source venv/bin/activate  # En Linux/Mac
    venv\Scripts\activate     # En Windows
    ```

3. **Instala las dependencias:**
    ```bash
    pip install django
    ```

## Configuración
- Usa una base de datos SQLite (db.sqlite3) por defecto.
- Las aplicaciones adopcion, mascota y usuario están configuradas en settings.py.

## Uso
1. **Aplica las migraciones:**
    ```bash
    python manage.py migrate
    ```
    Esto crea las tablas necesarias para los modelos en adopcion, mascota y usuario.

2. **Crea un superusuario (para acceder al admin):**
    ```bash
    python manage.py createsuperuser
    ```

3. **Inicia el servidor:**
    ```bash
    python manage.py runserver
    ```

4. **Explora las rutas disponibles:**
    Abre tu navegador en http://127.0.0.1:8000/ y prueba las siguientes URLs:
      - /: Página de inicio de sesión (usuario/login.html).

      - /admin/: Panel de administración de Django (requiere superusuario).

      - /mascota/: Rutas relacionadas con mascotas (definidas en mascota.urls).

      - /adopcion/: Rutas para solicitudes de adopción (definidas en adopcion.urls).

      - /usuario/: Rutas de gestión de usuarios (definidas en usuario.urls).

      - /accounts/login/: Página de inicio de sesión alternativa.

      - /logout/: Cierra sesión y redirige al login.

      - /reset/password_reset/: Formulario para restablecer contraseña.

      - /reset/password_reset_done/: Confirmación de envío de correo para restablecer contraseña.

      - /reset/<uidb64>/<token>/: Confirmación del restablecimiento de contraseña.

      - /reset/complete/: Página de restablecimiento completado.

## Estructura del proyecto
```bash
refugio/
├── manage.py              # Script de gestión de Django
├── db.sqlite3             # Base de datos SQLite
├── adopcion/              # Aplicación para solicitudes de adopción
│   ├── admin.py           # Configuración del admin
│   ├── forms.py           # Formularios para solicitudes
│   ├── models.py          # Modelos (Persona, Solicitud)
│   ├── urls.py            # Rutas específicas de adopción
│   ├── views.py           # Vistas para manejar solicitudes
│   └── migrations/        # Migraciones para modelos
├── mascota/               # Aplicación para gestión de mascotas
│   ├── admin.py           # Configuración del admin
│   ├── forms.py           # Formularios para mascotas
│   ├── models.py          # Modelos (Mascota, Vacuna)
│   ├── urls.py            # Rutas específicas de mascotas
│   ├── views.py           # Vistas para listar y gestionar mascotas
│   └── migrations/        # Migraciones para modelos
├── usuario/               # Aplicación para gestión de usuarios
│   ├── admin.py           # Configuración del admin
│   ├── forms.py           # Formularios para registro y login
│   ├── models.py          # Modelos de usuario (si los hay)
│   ├── serializers.py     # Serializadores (para APIs, si se usa REST)
│   ├── urls.py            # Rutas específicas de usuarios
│   └── views.py           # Vistas para autenticación
├── refugio/               # Configuración principal del proyecto
│   ├── settings.py        # Configuración global
│   ├── urls.py            # Rutas principales
│   └── wsgi.py            # Configuración WSGI
├── static/                # Archivos estáticos
│   ├── css/               # Estilos (Bootstrap)
│   └── js/                # Scripts (jQuery, Bootstrap)
└── templates/             # Plantillas HTML
    ├── adopcion/          # Plantillas para solicitudes
    ├── mascota/           # Plantillas para mascotas
    ├── base/             # Plantilla base
    ├── registration/     # Plantillas de autenticación
    └── usuario/           # Plantillas de login y registro
```
## Detalles del proyecto
- Propósito: Gestionar un refugio de mascotas, permitiendo registrar mascotas, procesar solicitudes de adopción y administrar usuarios.

- Estado: Proyecto funcional con autenticación básica, gestión de mascotas y adopciones.

## Características:
- Sistema de login/logout.

- Restablecimiento de contraseñas.

- Formularios y listas para mascotas y solicitudes de adopción.

- Uso de Bootstrap para el frontend.

## Próximos pasos
- Implementar una API REST con Django REST Framework para las aplicaciones.

- Agregar más estilos personalizados en static/css/.

- Mejorar las vistas y formularios con validaciones avanzadas.

- Configurar para producción (Gunicorn, Nginx, base de datos robusta).

## Notas
- Los archivos en __pycache__ son generados automáticamente y no deben incluirse en el control de versiones.

- Asegurate de configurar DEFAULT_AUTO_FIELD = 'django.db.models.BigAutoField' en settings.py para evitar warnings sobre claves primarias.

- Las migraciones reflejan cambios en modelos desde mayo de 2020; revisá su compatibilidad si actualizás Django.

## Licencia
Este proyecto no tiene una licencia definida. Es un desarrollo educativo/funcional para un refugio de mascotas.

