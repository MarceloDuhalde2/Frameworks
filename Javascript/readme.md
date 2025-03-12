# Lista de Tareas - Vue.js (vue-todo-app)

Esta es una aplicación web simple de lista de tareas desarrollada con **Vue.js 3**. Permite a los usuarios agregar tareas, marcarlas como completadas, filtrar entre tareas pendientes y completadas, y eliminar las tareas completadas. El proyecto utiliza la API de composición de Vue.js y está diseñado para ser ligero, funcionando directamente en el navegador sin necesidad de un entorno de desarrollo complejo.

## Ubicación en el Monorepo
Este proyecto se encuentra dentro del monorepo `Frameworks` en el subdirectorio:

Frameworks/Javascript/Vue.js/vue-todo-app


## Características
- **Agregar tareas**: Escribe una tarea y presiona Enter para añadirla a la lista.
- **Marcar como completada**: Usa un checkbox para togglear el estado de una tarea.
- **Filtrar tareas**: Cambia entre ver tareas pendientes o completadas con un botón.
- **Eliminar completadas**: Borra todas las tareas marcadas como completadas.
- **Contador**: Muestra el número de tareas pendientes en tiempo real.
- **Estilo básico**: Tareas completadas se muestran con tachado y botones desactivados cuando no aplican.

## Tecnologías Utilizadas
- **Vue.js 3**: Framework JavaScript para construir interfaces reactivas.
- **HTML/CSS**: Estructura y estilos básicos incluidos en el mismo archivo.
- **CDN**: Usa Vue.js directamente desde `unpkg` sin necesidad de instalación local.

## Instalación
Dado que esta aplicación funciona como un archivo HTML único con Vue.js cargado desde un CDN, no requiere instalación de dependencias ni un entorno de desarrollo completo. Sin embargo, puedes integrarlo en tu monorepo y probarlo localmente.

### Pasos
1. **Clonar el Monorepo (si aún no lo tienes):**
    ```bash
    git clone https://github.com/usuario/Frameworks.git
    cd Frameworks
    ```
2. **Navegar al Proyecto:**
    ```bash
    cd Javascript/Vue.js/vue-todo-app
    ```
3. **Abrir el Archivo:**
   - Abre index.html en un navegador directamente (doble clic o arrastrándolo al navegador).

   - Alternativamente, usa un servidor local para evitar problemas con CORS:
    ```bash
    npx serve
    ```
   - Luego accede a http://localhost:3000 (o el puerto que indique).

## Uso
1. **Agregar una tarea:**
   - Escribe en el campo de texto y presiona Enter.

2. **Marcar como completada:**
   - Haz clic en el checkbox junto a una tarea para marcarla o desmarcarla.

3. **Filtrar tareas:**
   - Usa el botón "Mostrar Completadas" o "Mostrar Pendientes" para alternar la vista.

4. **Eliminar tareas completadas:**
   - Haz clic en "Eliminar Completadas" (se habilita solo si hay tareas completadas).

## Estructura del Proyecto
   - index.html: Archivo principal que contiene el HTML, JavaScript (Vue.js) y CSS.

### Componentes
   - TaskItem: Componente Vue que representa cada tarea individual con un checkbox y texto.

### Lógica Principal
   - Estado Reactivo: Usa ref para manejar la lista de tareas y el input.

   - Computadas: 
     - tareasFiltradas: Filtra tareas según si están completadas o pendientes.

     - tareasPendientes: Cuenta las tareas no completadas.

     - hayCompletadas: Determina si hay tareas completadas para habilitar el botón de eliminación.

   - Métodos: 
     - agregarTarea: Añade una nueva tarea.

     - toggleTarea: Cambia el estado de una tarea.

     - eliminarCompletadas: Borra las tareas completadas.

## Ejemplo de Código
    ```bash
    <input type="text" v-model="nuevaTarea" @keyup.enter="agregarTarea" placeholder="Nueva tarea">
    <button @click="eliminarCompletadas" :disabled="!hayCompletadas">Eliminar Completadas</button>
    ```
## Notas Adicionales
   - Portabilidad: No requiere build ni dependencias locales, ideal para demostraciones rápidas.

   - Limitaciones: No persiste las tareas (se pierden al recargar la página). Para persistencia, considera agregar localStorage.

   - Estilo: CSS básico incluido en el archivo; las tareas completadas se muestran tachadas y los botones desactivados tienen opacidad reducida.

## Mejoras Futuras
   - Agregar persistencia con localStorage o una base de datos.

   - Implementar un diseño más avanzado con un framework CSS (como Tailwind o Bootstrap).

   - Convertir a un proyecto completo con Vite o Vue CLI para mayor escalabilidad.


### Desarrollado como parte del monorepo Frameworks por Marcelo Duhalde.

