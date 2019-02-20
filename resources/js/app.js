
window.axios = require('axios');


import Vue from 'vue'
import VueRouter from 'vue-router';
import { routes } from './routes';
import VueFullpage from 'fullpage-vue';
import VueTheMask from 'vue-the-mask';
import PrettyCheckbox from 'pretty-checkbox-vue';
import VueAwesomeSwiper from 'vue-awesome-swiper';
import Vuelidate from 'vuelidate';
// import vSuggest from 'v-suggest';
import vSelectPage from 'v-selectpage';




window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const { detect } = require('detect-browser');
const browser = detect();



Vue.use(VueRouter);
Vue.use(VueFullpage);
Vue.use(VueTheMask);
Vue.use(PrettyCheckbox);
Vue.use(Vuelidate);
// Vue.use(vSuggest);
Vue.use(vSelectPage);
Vue.use(VueAwesomeSwiper, /* { default global options } */);

const router = new VueRouter({
    mode: 'history',
    routes
});
new Vue({
  el: '#app',
  router,
  created() {
    if (browser.name == 'ie') {
      console.log(browser.name);
      console.log(browser.version);
      console.log(browser.os);
      this.$router.push('/browser-support');
    }
    if (browser.name == 'chrome') {
      console.log(browser.name);
      console.log(browser.version);
      console.log(browser.os);
    }
  }
});

if (browser.name == 'ie') {
  console.log(browser.name);
  console.log(browser.version);
  console.log(browser.os);
  this.$router.push('/browser-support');
}
if (browser.name == 'chrome') {
  console.log(browser.name);
  console.log(browser.version);
  console.log(browser.os);
  // Vue.$router.push('/browser-support');
}