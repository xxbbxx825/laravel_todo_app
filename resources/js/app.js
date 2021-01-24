require('./bootstrap');

import Vue from 'vue';
import store from './store';
import router from './router.js'
import HeaderComponent from "./components/layout/HeaderComponent";


window.Vue = require('vue');
window.state = store.state;

Vue.component('header-component', HeaderComponent);

new Vue({
    router: router,
    el: '#app',
});
