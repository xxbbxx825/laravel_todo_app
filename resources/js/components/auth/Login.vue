<template>
  <div class="container">
    <form class="form-group" @submit.prevent="login">
      <p>ログイン</p>
      <label for="email">Mail Address</label>
      <input type="email" class="form-control" id="email" v-model="email" />
      <label for="password">Password</label>
      <input
        type="password"
        class="form-control"
        id="password"
        v-model="password"
      />
      <button type="submit" class="btn btn-primary mt-3">ログイン</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      email: "",
      password: "",
    };
  },
  methods: {
    login() {
      this.$store.dispatch("login", {
        email: this.email,
        password: this.password,
      });
    },
  },
};
</script>
