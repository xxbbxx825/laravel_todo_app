<template>
  <div class="container">
    <p v-show="isError">登録に失敗しました。</p>
    <form class="form-group" @submit.prevent="register">
      <p>登録</p>
      <label for="name">Name</label>
      <input type="name" class="form-control" id="name" v-model="name" />
      <label for="email">Mail Address</label>
      <input type="email" class="form-control" id="email" v-model="email" />
      <label for="password">Password</label>
      <input
        type="password"
        class="form-control"
        id="password"
        v-model="password"
      />
      <label for="password_confirmation">Password Confirmation</label>
      <input
        type="password"
        class="form-control"
        id="password_confirmation"
        v-model="password_confirmation"
      />
      <button type="submit" class="btn btn-primary mt-3">登録</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isError: false,
      name,
      email,
      password,
      password_confirmation,
    };
  },
  methods: {
    register() {
      axios.post("/api/register", {
        name: this.name,
        email: this.email,
        password: this.password,
        password_confirmation: this.password_confirmation,
      });
      axios
        .post("/api/auth/login", {
          email: this.email,
          password: this.password,
        })
        .then((res) => {
          const token = res.data.access_token;
          axios.defaults.headers.common["Authorization"] = "Bearer " + token;
          state.isLogin = true;
          this.$router.push({ path: "/" });
        })
        .catch((error) => {
          this.isError = true;
        });
    },
  },
};
</script>
