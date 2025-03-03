# Proyecto Plantillas

Este proyecto de Django está diseñado para practicar y demostrar el uso de plantillas HTML en un entorno web. Contiene varias plantillas que muestran diferentes técnicas de renderizado, como variables, bucles, objetos y atajos, todas accesibles a través de rutas definidas.

## Requisitos
- Python 3.12
- Django (se recomienda instalarlo en un entorno virtual)

## Instalación

1. **Clona el repositorio (si está alojado en Git):**
   ```bash
   git clone https://github.com/tu_usuario/proyecto_plantillas.git
   cd proyecto_plantillas/proyecto_plantillas
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

- Las plantillas están configuradas en settings.py con la ruta BASE_DIR / 'proyecto_plantillas' / 'plantillas'.

## Uso

1. **Aplica las migraciones:**
    ```bash
    python manage.py migrate
    ```

2. **Inicia el servidor de desarrollo:**
    ```bash
    python manage.py runserver
    ```

3. **Explora las rutas:**
Abre tu navegador en http://127.0.0.1:8000/ y probá las siguientes rutas definidas:
   - /: Plantilla base (base.html).

   - /curso_c/: Ejemplo de curso C (curso_c.html).

   - /curso_css/: Ejemplo con CSS (curso_css.html).

   - /saludo_bucle/: Ejemplo con bucle (saludo_bucle.html).

   - /saludo_cargador/: Ejemplo con cargador (saludo_cargador.html).

   - /saludo/: Saludo básico (saludo.html).

   - /saludo_objeto/: Ejemplo con objetos (saludo_objeto.html).

   - /saludo_shortcut/: Ejemplo con shortcuts (saludo_shortcut.html).

   - /saludo_variable/: Ejemplo con variables (saludo_variable.html).

## Estructura del proyecto
```bash
proyecto_plantillas/
├── manage.py              # Script de gestión de Django
├── db.sqlite3             # Base de datos SQLite por defecto
└── proyecto_plantillas/   # Carpeta principal del proyecto
    ├── asgi.py            # Configuración ASGI
    ├── __init__.py        # Marca el directorio como paquete Python
    ├── plantillas/        # Carpeta con las plantillas HTML
    │   ├── base.html               # Plantilla base
    │   ├── curso_c.html            # Curso C
    │   ├── curso_css.html          # Curso con CSS
    │   ├── includes/               # Plantillas parciales
    │   │   └── barra_navegacion.html  # Barra de navegación reutilizable
    │   ├── saludo_bucle.html       # Ejemplo con bucle
    │   ├── saludo_cargador.html    # Ejemplo con cargador
    │   ├── saludo.html             # Saludo básico
    │   ├── saludo_objeto.html      # Ejemplo con objetos
    │   ├── saludo_shortcut.html    # Ejemplo con shortcuts
    │   └── saludo_variable.html    # Ejemplo con variables
    ├── settings.py        # Configuración del proyecto
    ├── urls.py            # Rutas definidas del proyecto
    ├── views.py           # Vistas para renderizar plantillas
    └── wsgi.py            # Configuración WSGI
```
## Detalles del proyecto
   - Propósito: Practicar el uso de plantillas en Django con ejemplos concretos.

   - Estado: Proyecto educativo completo con rutas definidas.

   - Características:
     - Plantilla base (base.html) y parciales (barra_navegacion.html) para diseño reutilizable.

     - Rutas específicas para cada plantilla, mostrando técnicas como bucles, variables y shortcuts.

## Próximos pasos
   - Añadir una aplicación con modelos para datos dinámicos.

   - Mejorar el diseño con CSS y agregar interactividad con JavaScript.

   - Configurar para producción (Gunicorn, Nginx, etc.).

## Licencia
Este proyecto no tiene una licencia definida. Es un ejercicio de aprendizaje.

