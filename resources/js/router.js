import Vue from 'vue'
import Router from 'vue-router'
import RegisterComponent from "./components/auth/Register"
import LoginComponent from "./components/auth/Login"
import TaskCreateComponent from "./components/TaskCreateComponent"
import TaskEditComponent from "./components/TaskEditComponent"
import TaskListComponent from "./components/TaskListComponent"
import TaskShowComponent from "./components/TaskShowComponent"
import SubTaskEditComponent from "./components/SubTaskEditComponent"
import UserComponent from "./components/UserComponent"

Vue.use(Router);

const router = new Router({
  mode: 'history',
  routes: [
      {
          path: '/login',
          name: 'login',
          component: LoginComponent
      },
      {
          path: '/register',
          name: 'register',
          component: RegisterComponent
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
      {
          path: '/tasks/:taskId',
          name: 'task.show',
          component: TaskShowComponent,
          meta: { requiresAuth: true },
          props: true
      },
      {
          path: '/sub_tasks/:subTaskId/edit',
          name: 'sub_task.edit',
          component: SubTaskEditComponent,
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
export default router
