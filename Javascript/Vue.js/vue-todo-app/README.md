# Lista de Tareas Simple - Vue.js

**Lista de Tareas Simple** es una aplicación web de página única (SPA) desarrollada con Vue.js 3, diseñada para gestionar tareas personales. Utiliza Vue Router para la navegación entre vistas, Pinia para la gestión de estado, y Bootstrap 5 para un diseño profesional y responsive. Este proyecto fue creado como parte de una preparación para una entrevista técnica, demostrando conocimientos en desarrollo frontend con Vue.js.

## Características

- **Gestión de Tareas**:
  - Agregar, marcar como completadas y eliminar tareas.
  - Filtrar tareas pendientes o completadas.
  - Eliminar todas las tareas completadas.
- **Navegación**:
  - Vista de lista de tareas (`/`) y detalles de una tarea (`/tarea/:id`) con Vue Router.
- **Gestión de Estado**:
  - Uso de Pinia para almacenar y gestionar la lista de tareas de forma reactiva.
- **Diseño**:
  - Estilizado con Bootstrap 5 para un diseño limpio, moderno y responsive.
- **Interactividad**:
  - Reactividad automática con propiedades computadas y eventos personalizados.

## Requisitos

- Node.js (versión 14.x o superior)
- npm (viene con Node.js)
- Un navegador moderno (Chrome, Firefox, etc.)

## Instalación

Sigue estos pasos para configurar el proyecto localmente:

1. **Clona el repositorio:**
   ```bash
   git clone <URL_DEL_REPOSITORIO>
   cd vue-todo-app

2. **Instala las dependencias:**
    ```bash
    npm install
    ```
3. **Inicia la aplicación:**
    ```bash
    npm run dev
    ```
- Esto iniciará un servidor de desarrollo. Abre tu navegador en http://localhost:5173/ (o el puerto que indique Vite).

## Uso
- Lista de Tareas:
  - Visita http://localhost:5173/ para ver la lista.
  - Escribe una tarea en el campo de texto y presiona Enter o haz clic en "Añadir" para agregarla.
  - Usa el checkbox para marcar tareas como completadas.
  - Haz clic en "Mostrar Completadas" o "Mostrar Pendientes" para filtrar.
  - Haz clic en "Eliminar Completadas" para limpiar las tareas marcadas.

- Detalles de Tarea:
  - Haz clic en el texto de una tarea para ver sus detalles en http://localhost:5173/tarea/:id.
  - Usa el botón "Volver a la Lista" para regresar.

## Estructura del Proyecto
```
vue-todo-app/
├── node_modules/          # Dependencias (ignorado por .gitignore)
├── public/                # Archivos públicos
├── src/
│   ├── assets/            # Recursos estáticos
│   ├── components/        # Componentes reutilizables
│   │   └── TaskItem.vue
│   ├── stores/            # Stores de Pinia
│   │   └── taskStore.js
│   ├── views/             # Vistas de la aplicación
│   │   ├── TaskList.vue
│   │   └── TaskDetail.vue
│   ├── App.vue            # Componente raíz
│   ├── main.js            # Punto de entrada de la app
│   └── style.css          # Estilos globales (opcional)
├── index.html             # Archivo HTML principal
├── package.json           # Configuración de dependencias y scripts
├── vite.config.js         # Configuración de Vite
├── README.md              # Documentación
└── .gitignore             # Archivos ignorados por Git
```
## Tecnologías Utilizadas
- Vue.js 3: Framework para construir la interfaz de usuario.

- Vue Router: Manejo de rutas y navegación.

- Pinia: Gestión de estado reactivo.

- Bootstrap 5: Estilizado profesional y responsive.

- Vite: Herramienta de desarrollo rápida y eficiente.

## Pruebas
Este proyecto no incluye pruebas unitarias actualmente, pero puedes agregarlas con herramientas como Vitest. Para empezar:
  - Instala Vitest: npm install --save-dev vitest @vue/test-utils.

  - Configura un archivo de pruebas (por ejemplo, src/tests/TaskList.spec.js).

## Contribuir
1. Forkea el repositorio.

2. Crea una nueva rama (git checkout -b feature/nueva-funcionalidad).

3. Realiza tus cambios y haz commit (git commit -m "Añadir nueva funcionalidad").

4. Haz push a tu rama (git push origin feature/nueva-funcionalidad).

5. Crea un Pull Request.

## Posibles Mejoras
- Agregar edición de tareas.

- Implementar persistencia con localStorage o una API externa (por ejemplo, conectar con Django).

- Añadir un tema oscuro con Bootstrap.

- Incluir animaciones con <transition-group>.

## Licencia
Este proyecto está bajo la Licencia MIT (pendiente de incluir archivo LICENSE).

## Autor
- Marcelo Duhalde
  
Desarrollado como preparación para una entrevista técnica.

