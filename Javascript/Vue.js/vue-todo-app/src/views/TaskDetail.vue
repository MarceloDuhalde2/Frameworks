<template>
    <div class="task-detail">
        <div v-if="tarea" class="card">
            <div class="card-body">
                <h2 class="card-title">Detalles de la Tarea</h2>
                <p class="card-text"><strong>Texto:</strong> {{ tarea.texto }}</p>
                <p class="card-text"><strong>Completada:</strong> {{ tarea.completada ? 'Sí' : 'No' }}</p>
                <button @click="$router.push('/')" class="btn btn-primary">Volver a la Lista</button>
            </div>
        </div>
        <div v-else class="alert alert-warning text-center">
            Tarea no encontrada.
            <button @click="$router.push('/')" class="btn btn-link">Volver a la Lista</button>
        </div>
    </div>
</template>

<script>
import { useTaskStore } from '../stores/taskStore';

export default {
    props: ['id'],
    setup() {
        const store = useTaskStore();
        return { store };
    },
    computed: {
        tarea() {
            return this.store.tareas.find(tarea => tarea.id === Number(this.id));
        }
    }
}
</script>

<style scoped>
.task-detail {
    padding: 20px;
}

.card {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.card-title {
    font-size: 1.5rem;
    color: #2c3e50;
    margin-bottom: 15px;
}

.card-text {
    font-size: 1.1rem;
    margin-bottom: 10px;
}

.card-text strong {
    color: #2c3e50;
}

.btn-link {
    color: #007bff;
}
</style>