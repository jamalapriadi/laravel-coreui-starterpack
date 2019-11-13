/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router'
import VueAxios from 'vue-axios'
import axios from 'axios'
import VueSweetalert2 from 'vue-sweetalert2';
import Spinner from 'vue-simple-spinner';
import Vuelidate from 'vuelidate';
import VeeValidate from 'vee-validate';
import Autocomplete from 'v-autocomplete'
import Snotify from 'vue-snotify';
import VueTimepicker from 'vue2-timepicker'
import CKEditor from '@ckeditor/ckeditor5-vue'
import BootstrapVue from 'bootstrap-vue'
import Multiselect from 'vue-multiselect'
import VoerroTagsInput from '@voerro/vue-tagsinput';
import Datetime from 'vue-datetime'
import VueGoogleCharts from 'vue-google-charts'
import VueMoment from 'vue-moment'
import LaravelPagination from 'laravel-vue-pagination'
import checkbox from 'vue-material-checkbox'
import ToggleButton from 'vue-js-toggle-button'

Vue.use(VueRouter)
Vue.use(VueAxios, axios)
Vue.use(VueSweetalert2);
Vue.use(Spinner);
Vue.use(Vuelidate);
Vue.use(VeeValidate, {
  errorBagName: '$errors',
  fieldsBagName: '$fields',
});
Vue.use(Autocomplete)
Vue.use(Snotify)
Vue.use(VueTimepicker)
Vue.use(VueMoment);
Vue.use(CKEditor);
Vue.use(BootstrapVue);
Vue.use(Datetime)
Vue.use(VueGoogleCharts)
Vue.use(checkbox)
Vue.use(ToggleButton)

// register plugin component
Vue.component('multiselect', Multiselect);
Vue.component('tags-input', VoerroTagsInput);
Vue.component('pagination', LaravelPagination);

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('setup-instansi', require('./components/Instansi.vue').default);

const routes = require('./routes').default
const router = new VueRouter({ routes });
const app = new Vue({ router }).$mount('#app');
