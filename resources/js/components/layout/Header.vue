<template>
  <div class="container-fluid bg-dark mb-3">
    <div class="container">
      <nav class="navbar navbar-dark">
        <span class="navbar-brand mb-0 h1">Yell</span>
        <template v-if="isLogIn">
          <router-link :to="{ name: 'task.list' }">
            <button class="btn btn-success">List</button>
          </router-link>
          <router-link :to="{ name: 'task.create' }">
            <button class="btn btn-success">Add</button>
          </router-link>
          <router-link :to="{ name: 'user' }">
            <button class="btn btn-success">User</button>
          </router-link>
          <button @click="logout" class="btn btn-success">logout</button>
        </template>
        <template v-else>
          <router-link :to="{ name: 'register' }">
            <button class="btn btn-success">register</button>
          </router-link>
          <router-link :to="{ name: 'login' }">
            <button class="btn btn-success">Login</button>
          </router-link>
        </template>
      </nav>
    </div>
  </div>
</template>

<script>
export default {
  computed: {
    isLogIn() {
      return this.$store.getters.accessToken !== null;
    }
  },
  methods: {
    logout() {
      this.$store.dispatch('logout');
    },
  },
};
</script>
