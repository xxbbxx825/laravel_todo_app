<template>
    <div class="container">
        <p v-show="isError">認証に失敗しました。</p>
        <form class="form-group" @submit.prevent="login">
            <p>ログイン</p>
            <label for="email">Mail Address</label>
            <input type="email" class="form-control" id="email" v-model="email">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" v-model="password">
            <button type="submit" class="btn btn-primary mt-3">ログイン</button>
        </form>
    </div>
</template>

<script>
export default {
    data () {
        return {
            isError: false,
            email: '',
            password: '',
        }
    },
    methods: {
        login() {
            axios.post('/api/auth/login', {
                email: this.email,
                password: this.password
            }).then(res => {
                const token = res.data.access_token;
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
                state.isLogin = true;
                this.$router.push({path: '/'});
            }).catch(error => {
                this.isError = true;
            });
        }
    }
}
</script>
