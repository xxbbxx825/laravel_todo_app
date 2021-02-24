import Vue from 'vue';
import Router from 'vue-router';
import store from "./store/index";
import Login from "./components/auth/Login";
import Register from "./components/auth/Register";
import TaskList from "./components/TaskList";
import TaskCreate from "./components/TaskCreate";
import TaskShow from "./components/TaskShow";
import TaskEdit from "./components/TaskEdit";
import SubTaskEdit from "./components/SubTaskEdit";
import UserIdentify from "./components/UserIdentify";

Vue.use(Router);

const router = new Router({
	mode: 'history',
	routes: [
		{
			path: '/login',
			name: 'login',
			component: Login,
			beforeEnter(to, from, next) {
				if (store.getters.accessToken) {
					next(from);
				} else {
					next();
				}
			}
		},
		{
			path: '/register',
			name: 'register',
			component: Register,
			beforeEnter(to, from, next) {
				if (store.getters.accessToken) {
					next(from);
				} else {
					next();
				}
			}
		},
		{
			path: '/user',
			name: 'user',
			component: UserIdentify,
		},
		{
			path: '/',
			name: 'task.list',
			component: TaskList,
			props: true,
			beforeEnter(to, from, next) {
				if (store.getters.accessToken) {
					next();
				} else {
					next('login');
				}
			}
		},
		{
			path: '/tasks/create',
			name: 'task.create',
			component: TaskCreate,
		},
		{
			path: '/tasks/:taskId/edit',
			name: 'task.edit',
			component: TaskEdit,
		},
		{
			path: '/tasks/:taskId',
			name: 'task.show',
			component: TaskShow,
			props: true
		},
		{
			path: '/sub_tasks/:subTaskId/edit',
			name: 'sub_task.edit',
			component: SubTaskEdit,
		},
	]
});

export default router
