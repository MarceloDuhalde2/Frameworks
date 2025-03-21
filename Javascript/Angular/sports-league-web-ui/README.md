# League Web UI

![League Web UI Logo](src/assets/images/logo.svg)

**League Web UI** es una aplicación web de una sola página (SPA) desarrollada en Angular que muestra información de una liga deportiva. Incluye un calendario de partidos, un ranking de equipos, y una página de error 404. La aplicación es responsiva y sigue un diseño visual especificado, con soporte para diferentes tamaños de pantalla (1000px, 750px, 500px).

## Características

- **Schedule Page**: Muestra una tabla con el calendario de partidos, incluyendo fecha, estadio, equipos, y resultados.
- **Leaderboard Page**: Muestra el ranking de equipos con estadísticas como partidos jugados, goles a favor, goles en contra, y puntos.
- **Not Found Page (404)**: Muestra una página de error para rutas no definidas, con una imagen `404.png` en su tamaño original (512x512px).
- **Responsividad**: Ajusta el diseño para diferentes tamaños de pantalla:
  - A 750px: Oculta la columna "Stadium" en la página de Schedule.
  - A 500px: Oculta la columna "Date/Time" en Schedule y muestra "GD" (Diferencia de Goles) en lugar de "GF"/"GA" en Leaderboard.
- **Pruebas Unitarias**: Incluye pruebas unitarias con Jest para los componentes y el servicio `LeagueService`.

## Tecnologías Utilizadas

- **Angular 13.2.7**: Framework principal para construir la SPA.
- **TypeScript**: Lenguaje para escribir el código de Angular.
- **HTML/CSS**: Para la estructura y los estilos, siguiendo el Visual Style Guide.
- **Jest**: Framework de pruebas unitarias.
- **Git**: Control de versiones.
- **Node.js/NPM**: Para gestionar dependencias y scripts.
- **Mock Server**: Servidor simulado para proporcionar datos JSON.

## Requisitos Previos

Antes de ejecutar el proyecto, asegúrate de tener instalado lo siguiente:

- **Node.js** (versión 14.x o superior): [Descargar Node.js](https://nodejs.org/)
- **NPM** (viene con Node.js)
- **Angular CLI** (versión 13.x): Instálalo globalmente con:
  ```bash
  npm install -g @angular/cli@13
  ```
- **Git**: Para clonar el repositorio.

## Instalación
Sigue estos pasos para instalar y ejecutar el proyecto localmente:
1. **Clona el Repositorio:**
    ```bash
    git clone https://github.com/<tu-usuario>/league-web-ui.git
    cd league-web-ui
    ```
2. **Instala las Dependencias:**
    ```bash
    npm install
    ```

3. **Inicia el Mock Server:**
    
    El proyecto usa un mock server para simular datos del backend. Inícialo con:
    ```bash
    node server.js dev-mock-server-config.json
    ```
    Esto inicia el servidor en http://localhost:3001.

4. **Inicia la Aplicación:**
    ```bash
    npm start
    ```
Esto inicia la aplicación en http://localhost:3000.

## Uso
- Página Principal (/ y /schedule): Muestra el calendario de partidos.

- Página de Ranking (/leaderboard): Muestra el ranking de equipos.

- Página 404 (/invalid): Muestra una página de error para rutas no definidas.

Prueba la responsividad reduciendo el ancho de la ventana del navegador a 750px y 500px para ver los ajustes en las tablas.

## Estructura del Proyecto
```
league-web-ui/
├── src/
│   ├── app/
│   │   ├── components/
│   │   │   ├── schedule/
│   │   │   │   ├── schedule.component.ts
│   │   │   │   ├── schedule.component.html
│   │   │   │   ├── schedule.component.css
│   │   │   │   ├── schedule.component.spec.ts
│   │   │   ├── leaderboard/
│   │   │   │   ├── leaderboard.component.ts
│   │   │   │   ├── leaderboard.component.html
│   │   │   │   ├── leaderboard.component.css
│   │   │   │   ├── leaderboard.component.spec.ts
│   │   │   ├── not-found/
│   │   │   │   ├── not-found.component.ts
│   │   │   │   ├── not-found.component.html
│   │   │   │   ├── not-found.component.css
│   │   │   │   ├── not-found.component.spec.ts
│   │   ├── services/
│   │   │   ├── league.service.ts
│   │   ├── app.component.ts
│   │   ├── app.component.html
│   │   ├── app.component.css
│   │   ├── app.module.ts
│   │   ├── app-routing.module.ts
│   ├── assets/
│   │   ├── images/
│   │   │   ├── logo.svg
│   │   │   ├── calendar.png
│   │   │   ├── leaderboard.png
│   │   │   ├── 404.png
│   ├── styles.css
├── tests/
│   ├── leaderboard.test.ts
├── server.js
├── dev-mock-server-config.json
├── package.json
├── README.md
```
## Pruebas Unitarias
El proyecto incluye pruebas unitarias con Jest. Para ejecutarlas:
  ```bash
  npm test
  ```
- schedule.component.spec.ts: Prueba la creación del componente y la carga de partidos.

- leaderboard.test.ts: Prueba la lógica del ranking en LeagueService.

## Construcción para Producción
Para generar una versión optimizada para producción:
  ```bash
  npm run build
  ```
Esto genera los archivos compilados en el directorio dist/. Puedes servirlos con un servidor web (e.g., http-server).

## Contribución
1. **Clona el repositorio y crea una nueva rama:**
    ```bash
    git checkout -b feature/nueva-funcionalidad
    ```
2. **Haz tus cambios y commitea:**
    ```bash
    git add .
    git commit -m "Añadir nueva funcionalidad"
    ```
3. **Haz push a tu rama:**
    ```bash
    git push origin feature/nueva-funcionalidad
    ```
4. **Crea un Pull Request en GitHub.**

## Licencia
Este proyecto está bajo la Licencia MIT. Consulta el archivo LICENSE para más detalles.

## Autor
Marcelo Duhalde

## Agradecimientos
- A xAI por la asistencia en el desarrollo y debugueo del proyecto.

- Al equipo de Angular por proporcionar un framework robusto para SPAs.