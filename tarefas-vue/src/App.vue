<template>
	<div id="app">
		<h1>Tarefas</h1>
		<TaskProgress :progress="preogress" />
		<NewTask  @newTask="add" />
		<TaskGrid :tasks="tasks" @taskStateChanged="toggleTaskState" @removeTask="remove" @editTask="edit" />
	</div>
</template>

<script>
import api from './utils/api'
import Swal from 'sweetalert2'

import TaskProgress from './components/TaskProgress'
import NewTask from './components/NewTask'
import TaskGrid from './components/TaskGrid'

export default {
	components:{
		TaskProgress,
		NewTask,
		TaskGrid,
	},
	data(){
		return{
			tasks:[]	
		}
	},
	computed:{
		preogress(){
			const total = this.tasks.length
			const done = this.tasks.filter(t => !t.pending).length
			return Math.round(done / total * 100) || 0
		}
	},
	methods:{
		async loadAllTasks(){
			await api.get('/tarefa')
			.then(res=>{
				this.tasks = res.data
			})
		},
		async add(task){

			const sameName = t => t.name === task
			
			const reallyNew = (this.tasks.filter(sameName).length == 0)
			
			if(reallyNew && task !== ''){

				await api.post('/tarefa',{
					name:task,
					pending:true,
				})
				.then(res =>{
					this.tasks.push(res.data.tarefa)
				})
			}else{
				Swal.fire({
					title: 'Ops...',
					text: 'Essa tarefa já existe!',
					icon: 'warning',
					confirmButtonText: 'Ok'
				})
			}

		},
		async edit(task){

			const { value: updateTask } = await Swal.fire({
                title: 'Alterar Tarefa',
                input: 'text',
                inputValue: task.name,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: "Cancelar",
                confirmButtonText: 'Alterar',
            })

			if(updateTask){

				if(task.name !== updateTask){

					console.log(updateTask)
					await api.put(`/tarefa/${task.id}`,{
						name: updateTask,
						pending: task.pending
					})
					.then((res)=>{
						this.loadAllTasks()
						Swal.fire({
							title: 'Show!',
							text: res.data.message,
							icon: 'success',
							confirmButtonText: 'Ok'
						})
					})

				}else{
					 Swal.fire({
                        title: 'Ops...',
                        text: 'A tarefa não teve mudança, altere o nome da tarefa para atualizar',
                        icon: 'warning',
                        confirmButtonText: 'Ok'
                    })
				}

            }

		},
		async remove(task){

			const { value: accept } = await Swal.fire({

                title: `Você tem certeza que deseja exluir a tarefa ${task.name.toLowerCase()}?`,
                text: "Você não poderá reverter essa ação mais tarde!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                cancelButtonText: "Cancelar",
                confirmButtonText: 'Excluir'

            })

			if(accept){

                await api.delete(`/tarefa/${task.id}`)
                .then(res =>{
                    

                    Swal.fire({
                        title: 'Show!',
                        text: res.data.message,
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    })
					
					this.tasks = this.tasks.filter(t => t.name !== task.name)
                })
				
            }

		},
		toggleTaskState(i){
			this.tasks[i].pending = !this.tasks[i].pending
		}
	},
	mounted(){
		this.loadAllTasks()
	}


}
</script>

<style>
	body {
		font-family: 'Lato', sans-serif;
		background: linear-gradient(to right, rgb(22, 34, 42), rgb(58, 96, 115));
		color: #FFF;
	}

	#app {
		display: flex;
		flex: 1;
		flex-direction: column;
		justify-content: center;
		align-items: center;
		height: 100vh;
	}

	#app h1 {
		margin-bottom: 5px;
		font-weight: 300;
		font-size: 3rem;
		
	}
</style>
