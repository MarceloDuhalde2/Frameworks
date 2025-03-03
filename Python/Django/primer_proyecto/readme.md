# Primer Proyecto

Este es un proyecto básico creado con Django para aprender los fundamentos del framework. Hasta ahora, incluye la configuración inicial de un proyecto Django con las migraciones aplicadas y el servidor de desarrollo funcionando.

## Requisitos
- Python 3.x (probado con Python 3.12)
- Django (instalado en el entorno virtual)

## Instalación

1. **Clona el repositorio (si está en Git):**
   ```bash
   git clone https://github.com/tu_usuario/primer_proyecto.git
   cd primer_proyecto
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
## Uso
1. **Aplica las migraciones iniciales:**
    ```bash
    python manage.py migrate
    ```
2. **Inicia el servidor de desarrollo:**
    ```bash
    python manage.py runserver
    ```
3. **Abre tu navegador y visita:**
    ```bash
    http://127.0.0.1:8000/
    ```
4. **Deberías ver la página de bienvenida de Django si todo está configurado correctamente**.

## Estado del proyecto

- Este proyecto está en una etapa inicial. Solo incluye:
  - La estructura básica de un proyecto Django (manage.py, settings.py, urls.py, etc.).

- Las migraciones iniciales aplicadas para las aplicaciones integradas de Django (admin, auth, contenttypes, sessions).

- El servidor de desarrollo funcionando localmente.

## Próximos pasos
1. **Crear una aplicación personalizada con startapp.**

2. **Añadir vistas, modelos y URLs.**

3. **Configurar un entorno de producción.**

## Licencia
Este proyecto no tiene una licencia definida aún. Es solo un ejercicio de aprendizaje.
