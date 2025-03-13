<template>
    <div class="task-list">
        <h1 class="mb-4 text-center">Mi Lista de Tareas</h1>
        <div class="input-group mb-3">
            <input type="text" class="form-control" v-model="nuevaTarea" @keyup.enter="agregarTarea" placeholder="Nueva tarea">
            <button class="btn btn-primary" @click="agregarTarea" :disabled="!nuevaTarea.trim()">Añadir</button>
        </div>
        <p class="text-muted mb-3">Tareas pendientes: {{ tareasPendientes }}</p>
        <div class="d-flex gap-2 mb-3">
            <button class="btn btn-outline-secondary" @click="mostrarCompletadas = !mostrarCompletadas">
                {{ mostrarCompletadas ? 'Mostrar Pendientes' : 'Mostrar Completadas' }}
            </button>
            <button class="btn btn-danger" @click="eliminarCompletadas" :disabled="!hayCompletadas">
                Eliminar Completadas
            </button>
        </div>
        <div v-if="tareasFiltradas.length === 0" class="alert alert-info text-center">
            No hay {{ mostrarCompletadas ? 'tareas completadas' : 'tareas pendientes' }}.
        </div>
        <ul v-else class="list-group">
            <task-item
                v-for="tarea in tareasFiltradas"
                :key="tarea.id"
                :tarea="tarea"
                @toggle="toggleTarea"
            />
        </ul>
    </div>
</template>

<script>
import TaskItem from '../components/TaskItem.vue';
import { useTaskStore } from '../stores/taskStore';

export default {
    components: {
        TaskItem
    },
    setup() {
        const store = useTaskStore();
        return { store };
    },
    data() {
        return {
            nuevaTarea: '',
            mostrarCompletadas: false
        }
    },
    computed: {
        tareas() {
            return this.store.tareas;
        },
        tareasFiltradas() {
            return this.mostrarCompletadas
                ? this.tareas.filter(tarea => tarea.completada)
                : this.tareas.filter(tarea => !tarea.completada);
        },
        tareasPendientes() {
            return this.tareas.filter(tarea => !tarea.completada).length;
        },
        hayCompletadas() {
            return this.tareas.some(tarea => tarea.completada);
        }
    },
    methods: {
        agregarTarea() {
            if (this.nuevaTarea.trim()) {
                this.store.agregarTarea({
                    id: Date.now(),
                    texto: this.nuevaTarea.trim(),
                    completada: false
                });
                this.nuevaTarea = '';
            }
        },
        toggleTarea(tarea) {
            this.store.toggleTarea(tarea.id);
        },
        eliminarCompletadas() {
            this.store.eliminarCompletadas();
        }
    }
}
</script>

<style scoped>
.task-list {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

h1 {
    font-size: 2rem;
    color: #2c3e50;
    margin-bottom: 1.5rem;
}

.input-group {
    margin-bottom: 1.5rem;
    box-shadow: none; /* Eliminar sombra del input-group para evitar superposición */
}

.form-control {
    border-radius: 0.25rem 0 0 0.25rem; /* Asegura que los bordes coincidan */
}

.input-group button {
    border-radius: 0 0.25rem 0.25rem 0; /* Bordes redondeados solo en el lado derecho */
}

.task-count {
    font-size: 1.1rem;
    color: #666;
    margin-bottom: 1rem;
}

.filters {
    display: flex;
    gap: 0.5rem;
    margin-bottom: 1.5rem;
}

.alert {
    margin-bottom: 1.5rem;
}

.list-group {
    margin-bottom: 1rem;
}
</style>