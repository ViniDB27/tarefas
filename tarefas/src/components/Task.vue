<template>
        
    <div class="task-container col-4 offset-4" >
        <div>
            <h1>{{ task.title }}</h1>
        </div>
        <div>
            <button @click="alterTask" class="update" >Alterar</button>
            <button @click="removeTask" class="delete" >Deletar</button>
        </div>
    </div>

       
</template>

<script>



export default {
    props:[
        'task',
    ],
    methods:{
        removeTask(){
            this.$emit('deleteTask', this.task)
        },
        alterTask(){
            this.$emit('updateTask', this.task)
        }
    }
}
</script>

<style scoped>
.task-container{
    width: 300px;
    height: 100px;
    background-color: #fff;

    display: flex;
    justify-content: center;
    align-items: center;

    border-radius: 10px;

   margin-bottom: 5px;
   margin-top: 5px;
}

.task-container > div:first-child{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    width: 200px;
}

.task-container h1{
    font-size: 16pt;
    font-weight: bold;
}

.task-container > div:last-child{
    width: 100px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.task-container button{
    width: 80px;
    height: 30px;

    display: flex;
    justify-content: center;
    align-items: center;

    font-size: 10pt;
    margin: 2.5px;

    border-radius: 5px;
}

.task-container .update{
    background-color: #2e38a8;
    color: #fff;
    border:none;
    transition: 1s;
}

.task-container .update:hover{
    background-color: #141c6e;
}

.task-container .delete{
    background-color: #b1233b;
    color: #fff;
    border:none;
    transition: 1s;
}

.task-container .delete:hover{
    background-color: #801023;
}

.modal{
    width: 100vw !important;
}


.title-input{
    border: none;
    border-bottom: 1px solid rgb(114, 110, 110);
    outline: 0;
}

.title-input:focus{
    border-bottom: 1px solid #1f2888;
}

</style>