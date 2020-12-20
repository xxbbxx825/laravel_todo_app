import Vue from 'vue'
import VueRouter from "vue-router"

Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: 'api/tasks',
            name: 'task.list',
            component: TaskListComponent
        },
        {
            path: 'api/tasks',
            name: 'task.create',
            component: TaskCreateComponent
        },
        {
            path: '/tasks/:taskId/edit',
            name: 'task.edit',
            component: TaskEditComponent,
            props: true
        },
        {
            path: '/tasks/:taskId/edit',
            name: 'task.edit',
            component: TaskEditComponent,
            props: true
        },
        {
            path: "/login",
            name: "login",
            component: Login,
            meta: {
                auth: false
            }
        },
    ]
});

export default router
