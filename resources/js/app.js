require('./bootstrap');

import Vue from 'vue';
import store from './store';
import VueRouter from 'vue-router';
import HeaderComponent from "./components/HeaderComponent";
import LoginComponent from "./components/LoginComponent";
import TaskCreateComponent from "./components/TaskCreateComponent";
import TaskEditComponent from "./components/TaskEditComponent";
import TaskListComponent from "./components/TaskListComponent";
import UserComponent from "./components/UserComponent";

window.Vue = require('vue');
window.state = store.state;

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/login',
            name: 'login',
            component: LoginComponent
        },
        {
            path: '/user',
            name: 'user',
            component: UserComponent,
            meta: { requiresAuth: true }
        },
        {
            path: '/',
            name: 'task.list',
            component: TaskListComponent,
            meta: { requiresAuth: true }
        },
        {
            path: '/tasks/create',
            name: 'task.create',
            component: TaskCreateComponent,
            meta: { requiresAuth: true }
        },
        {
            path: '/tasks/:taskId/edit',
            name: 'task.edit',
            component: TaskEditComponent,
            meta: { requiresAuth: true },
            props: true
        },
    ]
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (state.isLogin === false) {
            next({
                path: '/login',
                query: { redirect: to.fullPath }
            })
        } else {
            next()
        }
    } else {
        next();
    }
});


Vue.component('header-component', HeaderComponent);

const app = new Vue({
    el: '#app',
    router,
});
