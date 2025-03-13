<template>
    <li class="list-group-item d-flex align-items-center gap-2">
        <input type="checkbox" v-model="tarea.completada" @change="toggle">
        <router-link :to="{ name: 'TaskDetail', params: { id: tarea.id } }" class="flex-grow-1">
            {{ tarea.texto }}
        </router-link>
    </li>
</template>

<script>
export default {
    props: ['tarea'],
    methods: {
        toggle() {
            this.$emit('toggle', this.tarea);
        }
    }
}
</script>

<style scoped>
.list-group-item {
    transition: background-color 0.3s;
}

.list-group-item:hover {
    background-color: #f1f5f9;
}

input[type="checkbox"] {
    width: 18px;
    height: 18px;
    cursor: pointer;
}

a {
    color: #2c3e50;
    text-decoration: none;
    transition: color 0.3s;
}

a:hover {
    color: #42b983;
}

.completed a {
    text-decoration: line-through;
    color: #6c757d;
}
</style>