<template>
  <div class="container-fluid bg-dark mb-3">
    <div class="container">
      <nav class="navbar navbar-dark">
        <span class="navbar-brand mb-0 h1">todo</span>
        <div>
            <router-link v-bind:to="{ name: 'task.list' }">
              <button class="btn btn-success">List</button>
            </router-link>
            <router-link v-bind:to="{ name: 'task.create' }">
              <button class="btn btn-success">Add</button>
            </router-link>
            <router-link v-bind:to="{ name: 'user' }">
              <button class="btn btn-success">User</button>
            </router-link>
            <router-link v-bind:to="{ name: 'login' }">
              <button class="btn btn-success">Login</button>
            </router-link>
            <button @click="logout" class="btn btn-success">logout</button>
        </div>
      </nav>
    </div>
  </div>
</template>

<script>
    export default {
        methods: {
            logout() {
                axios.post('api/auth/logout').then(res => {
                    axios.defaults.headers.common['Authorization'] = '';
                    state.isLogin = false;
                    this.$router.push({path: '/login'});
                });
            },
        }
    }
</script>
