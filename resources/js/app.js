
require('./bootstrap');
import { App, plugin } from '@inertiajs/inertia-vue'
import Vue from 'vue'

import { InertiaProgress } from '@inertiajs/progress'
import VueApexCharts from 'vue-apexcharts'
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import Toast from "vue-toastification";
// Import the CSS or use your own!
import "vue-toastification/dist/index.css";

import { CoolSelectPlugin } from 'vue-cool-select'
import Permissions from './mixins/Permissions';
Vue.mixin(Permissions);
 
// paste the line below only if you need "bootstrap" theme
import 'vue-cool-select/dist/themes/bootstrap.css'

Vue.use(require('vue-moment'));
Vue.use(CoolSelectPlugin)

InertiaProgress.init()

Vue.use(VueApexCharts)

Vue.component('apexchart', VueApexCharts)

Vue.prototype.$route = route

Vue.use(plugin)

Vue.use(VueSweetalert2);

Vue.component('pagination', require('laravel-vue-pagination'));

const options = {
  // You can set your default options here
};


Vue.use(Toast, options);

const el = document.getElementById('app')


new Vue({
  render: h => h(App, {
    props: {
      initialPage: JSON.parse(el.dataset.page),
      resolveComponent: name => require(`./Pages/${name}`).default,
    },
  }),
}).$mount(el)
