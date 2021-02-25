<template>
    <div class="container" >
        <div class="row" >
            <FormTasks @newTask="createNewTask" />
            <Tasks v-for="task in tasks" :key="task.id" :task="task" @deleteTask="removeTask" @updateTask="alterTask"  />
        </div>
    </div>
</template>

<script>
import FormTasks from './FormTasks'
import Tasks from './Task'
import api from '../utils/api'
import Swal from 'sweetalert2'

export default {
    data(){
        return{
            tasks:[],
            createTask: undefined,
        }
    },
    components:{
        FormTasks,
        Tasks,
        
    },
    methods:{
        async loadAllTask(){
            await api.get('tarefa')
            .then(res=>{
                this.tasks = res.data
            })
        },
        async createNewTask(event){
            await api.post('/tarefa',{
                title:event
            })
            .then(res=>{
                this.tasks.push(res.data.tarefa)
                Swal.fire({
                    title: 'Show!',
                    text: `Tarefa ${res.data.tarefa.title} adicionada com sucesso.`,
                    icon: 'success',
                    confirmButtonText: 'Ok'
                })
            })
        },
        async alterTask(event){

            const { value: updateTask } = await Swal.fire({
                title: 'Alterar Tarefa',
                input: 'text',
                inputValue: event.title,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: "Cancelar",
                confirmButtonText: 'Alterar',
            })

            if(updateTask && event.title !== updateTask){
                console.log(updateTask)
                await api.put(`/tarefa/${event.id}`,{
                    title:updateTask
                })
                .then((res)=>{
                    this.loadAllTask()
                    Swal.fire({
                        title: 'Show!',
                        text: res.data.message,
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    })
                })
            }

        },
        async removeTask(event){

            const { value: accept } = await Swal.fire({

                title: `Você tem certeza que deseja exluir a tarefa ${event.title}?`,
                text: "Você não poderá reverter essa ação mais tarde!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                cancelButtonText: "Cancelar",
                confirmButtonText: 'Excluir'

            })

            if(accept){

                await api.delete(`/tarefa/${event.id}`)
                .then(res =>{
                    
                    this.loadAllTask()

                    Swal.fire({
                        title: 'Show!',
                        text: res.data.message,
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    })
                })
            }

        }
    },
    mounted(){
        this.loadAllTask()
    }
}
</script>

<style scoped>
.list-task{
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>
