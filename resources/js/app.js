/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;
import GlobalsMixins from '@/vue/mixins/Globals';
import VueTheMask from 'vue-the-mask'
import money from 'v-money'
import vmodal from 'vue-js-modal'
import VueTour from 'vue-tour'

Vue.use(VueTheMask);
Vue.use(VueTour);
Vue.use(money, {precision: 2, decimal: ',', thousands: '.',});
Vue.use(vmodal, {
  dynamicDefaults: {
    draggable: true,
    resizable: true,
    height: 'auto',
    minHeight: 200
  }
})


import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
require('vue-tour/dist/vue-tour.css')



Vue.use(VueSweetalert2);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('customers-index', require('./components/customers/Index.vue').default);
Vue.component('customers-form', require('./components/customers/Form.vue').default);
Vue.component('customers-list', require('./components/customers/List.vue').default);

Vue.component('numbers-index', require('./components/numbers/Index.vue').default);
Vue.component('numbers-form', require('./components/numbers/Form.vue').default);
Vue.component('numbers-list', require('./components/numbers/List.vue').default);
Vue.component('dashboard-index', require('./components/dashboard/Index.vue').default);
Vue.component('teste', require('./components/Test.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.mixin(GlobalsMixins);

const app = new Vue({
    el: '#app',
});

