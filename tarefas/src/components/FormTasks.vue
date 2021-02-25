<template>
    <div class="col-4 offset-4 mb-4 container-form" >
        <form>
                <h2>Cadastrar Tarefas</h2>
             <div class="mb-3">
                <input v-model="title" type="text" class="title-input" id="title" placeholder="Tarefa">
            </div>
            <button @click="seendTask" type="button" class="task-cad">Cadastrar tarefa</button>
        </form>
    </div>
</template>

<script>
export default {
    data(){
        return{
            title:'',
        }
    },
    methods:{
        seendTask(){
            this.$emit('newTask', this.title)
            this.title = ''
        }
    }
}
</script>

<style scoped>
.container-form{    
    width: 300px;
    height: 160px;

    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    margin-top: 20px;

    box-shadow: 0 0 2.5 black;
}

.container-form h2{
    font-size: 16pt;
}

.container-form input{
    border: none;
    border-bottom: 1px solid #ccc;
    outline: 0;
}

.container-form input:focus{
    border-bottom: 1px solid #1f2888;
}

.container-form button{
    background-color: #2e38a8;
    color: #fff;
    border:none;
    transition: 0.5s;

    widows: 400px;
    height: 40px;
    padding: 0 20px;

    text-align: center;
    border-radius: 10px;
}

.container-form button:hover{
    background-color: #141c6e;
    text-decoration: underline;
}

</style>