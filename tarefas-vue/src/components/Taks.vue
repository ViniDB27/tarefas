<template>
        <div class="task" :class="stateClass" @click="$emit('taskStateChanged', task)">
            <span @click.stop="$emit('removeTask', task)" class="close material-icons" title="Excluir" >close</span>
            <span @click.stop="$emit('editTask', task)" class="edit material-icons" title="Editar" >edit</span>
            <p>{{ task.name }}</p>
        </div>
</template>

<script>
export default {
    props:{
        task:{
            type: Object,
            required: true
        }
    },
    computed:{
        stateClass(){
            return {
                pending: this.task.pending,
                done: !this.task.pending
            }
        }
    },
}
</script>

<style scoped>
    .task{
        position: relative;
        box-sizing: border-box;
        width: 350px;
        height: 150px;
        padding: 10px;
        border-radius: 10px;
        font-size: 2rem;
        font-weight: 300;
        cursor: pointer;
        user-select: none;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .pending {
        border-left: 12px solid #B73229;
        background: #F44336;
    }

    .done{
        color: #DDD;
        border-left: 12px solid #0A8F08;
        background: #4CAF50;
        text-decoration: line-through;
    }

    .pending .close, .pending .edit{
        background: #B73229;
    }

    .done .close, .done .edit{
        background: #0A8F08;
    }

    .close{
        position: absolute;
        right: 10px;
        top: 10px;

        font-size: 0.9rem;
        font-weight: 600;

        height: 25px;
        width: 25px;

        border-radius: 50%;

        display: flex;
        justify-content: center;
        align-items: center;
    }

    .edit{
        position: absolute;
        right: 40px;
        top: 10px;

        font-size: 0.9rem;
        font-weight: 600;

        height: 25px;
        width: 25px;

        border-radius: 50%;

        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>