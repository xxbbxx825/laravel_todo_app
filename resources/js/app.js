require('./bootstrap');
import Vue from 'vue';
import store from './store/index';
import router from './router';
import axios from "axios";
import App from './components/App';

Vue.config.productionTip = false;
store.dispatch('autoLogin');

new Vue({
  router: router,
  store: store,
  render: createElement => createElement(App),
}).$mount('#app');
