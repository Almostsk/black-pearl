
window.axios = require('axios');


import Vue from 'vue'
import VueRouter from 'vue-router';
import { routes } from './routes';
import VueFullpage from 'fullpage-vue';
import VueTheMask from 'vue-the-mask';
import PrettyCheckbox from 'pretty-checkbox-vue';
import VueAwesomeSwiper from 'vue-awesome-swiper';


window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';



Vue.use(VueRouter);
Vue.use(VueFullpage);
Vue.use(VueTheMask);
Vue.use(PrettyCheckbox);
Vue.use(VueAwesomeSwiper, /* { default global options } */)

const router = new VueRouter({
    mode: 'history',
    routes
});
new Vue({
  el: '#app',
  router
});