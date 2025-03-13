import { defineStore } from 'pinia';

export const useTaskStore = defineStore('task', {
    state: () => ({
        tareas: []
    }),
    actions: {
        agregarTarea(tarea) {
            this.tareas.push(tarea);
        },
        toggleTarea(id) {
            const tarea = this.tareas.find(tarea => tarea.id === id);
            if (tarea) {
                tarea.completada = !tarea.completada;
            }
        },
        eliminarCompletadas() {
            this.tareas = this.tareas.filter(tarea => !tarea.completada);
        }
    }
});