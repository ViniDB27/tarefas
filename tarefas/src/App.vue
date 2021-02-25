<template>
  <div id="app">
    <TasksList />
  </div>
</template>

<script>
import TasksList from './components/TasksList.vue'

export default {
  name: 'App',
  components: {
    TasksList
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  background-color: #cecece;
  width: 100%;
  height: 100%;
  min-height: 100vh;
  overflow: auto;
  padding-bottom: 25px;
  position: relative;
}
a{
  cursor: pointer;
}
</style>
