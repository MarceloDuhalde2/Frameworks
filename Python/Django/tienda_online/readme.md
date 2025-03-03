# Tienda Online

Este proyecto de Django está diseñado para ser un sistema de gestión de pedidos para una tienda online. Se encuentra en una etapa inicial de desarrollo y contiene una aplicación básica (`gestion_pedidos`) con modelos, vistas, formularios y plantillas para manejar productos, clientes y pedidos. El objetivo es proporcionar una base funcional que pueda expandirse con más características.

## Requisitos
- Python 3.12 (compatible también con 3.6 según archivos compilados)
- Django (instalado en un entorno virtual recomendado)

## Instalación

1. **Clona el repositorio (si está alojado en Git):**
    ```bash
    git clone https://github.com/tu_usuario/tienda_online.git
    cd tienda_online
    ```
2. **Crea y activa un entorno virtual (opcional pero recomendado):**
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
   - Usa una base de datos SQLite por defecto (db.sqlite3).
   - La app gestion_pedidos está incluida en INSTALLED_APPS en settings.py.

## Uso
1. **Aplica las migraciones:**
    ```bash
    python manage.py migrate
    ```
    Esto configura las tablas para los modelos definidos en gestion_pedidos.

2. **Inicia el servidor de desarrollo:**
    ```bash
    python manage.py runserver
    ```

3. **Explora el proyecto:**
   - Visita http://127.0.0.1:8000/ en tu navegador.
   - Ejemplos de rutas disponibles (según las plantillas):
     - /busqueda_productos/: Formulario de búsqueda de productos.
     - /contacto/: Página de contacto.
     - /resultado_busqueda/: Resultados de búsqueda.

## Estructura del proyecto
    tienda_online/
    ├── manage.py              # Script de gestión de Django
    ├── db.sqlite3             # Base de datos SQLite
    ├── gestion_pedidos/       # Aplicación principal
    │   ├── admin.py           # Configuración del admin de Django
    │   ├── apps.py            # Configuración de la app
    │   ├── forms.py           # Formularios para interacción con usuarios
    │   ├── __init__.py        # Marca el directorio como paquete
    │   ├── migrations/        # Migraciones de la base de datos
    │   │   ├── 0001_initial.py                  # Migración inicial
    │   │   ├── 0002_auto_20200516_1251.py       # Cambios automáticos
    │   │   ├── 0003_alter_articulos_id_...      # Ajustes en claves primarias
    │   │   └── __init__.py
    │   ├── models.py          # Modelos (Articulos, Clientes, Pedidos, etc.)
    │   ├── templates/         # Plantillas HTML
    │   │   ├── busqueda_productos.html    # Búsqueda de productos
    │   │   ├── contacto2.html             # Variante de contacto
    │   │   ├── contacto.html             # Formulario de contacto
    │   │   ├── gracias.html              # Página de agradecimiento
    │   │   └── resultado_busqueda.html   # Resultados de búsqueda
    │   ├── tests.py           # Pruebas unitarias
    │   └── views.py           # Vistas para manejar las rutas
    └── tienda_online/         # Carpeta principal del proyecto
        ├── asgi.py            # Configuración ASGI
        ├── __init__.py        # Marca el directorio como paquete
        ├── settings.py        # Configuración del proyecto
        ├── urls.py            # Rutas del proyecto
        └── wsgi.py            # Configuración WSGI

## Detalles del proyecto
   - Propósito: Crear un sistema de gestión de pedidos para una tienda online, con funcionalidades como búsqueda de productos y contacto.

   - Estado: Etapa inicial de desarrollo. Incluye modelos básicos, formularios y plantillas, pero aún falta implementar lógica avanzada.

   - Características actuales:
     - Modelos para artículos, clientes y pedidos definidos en models.py.
     - Plantillas para búsqueda y contacto.
     - Migraciones aplicadas para la estructura inicial de la base de datos.

## Próximos pasos
   - Completar las vistas para gestionar pedidos (crear, listar, editar).

   - Añadir estilos CSS y diseño responsive a las plantillas.

   - Implementar autenticación de usuarios.

   - Preparar para producción con un servidor como Gunicorn y una base de datos más robusta (opcional).

## Licencia
Este proyecto no tiene una licencia definida. Es un ejercicio educativo en desarrollo.

