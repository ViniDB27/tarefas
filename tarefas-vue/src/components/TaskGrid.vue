<template>

    <div class="task-grid" >

        <template v-if="tasks.length">
            <Task v-for="(task, i) in tasks" :key="task.name" :task="task" @taskStateChanged="$emit('taskStateChanged', i)" @editTask="$emit('editTask', task)" @removeTask="$emit('removeTask', task)" />
        </template>
        <p v-else class="no-task">Sua vida está em dia :)</p>

    </div>

</template>

<script>
import Task from './Taks'

export default {
    components:{
        Task
    },
    props:{
        tasks: {
            type: Array,
            required: true
        }
    },
    methods:{
        dellTask(task){
            this.$emit('deleteTask', task)
        }
    }
}

</script>

<style scoped>
    .task-grid{
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
    }

    .task-grid .task{
        margin: 10px;
    }

    .no-task{
        color: #AAA;
        font-size: 1.7rem;
    }
</style>