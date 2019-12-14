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
import VueYouTubeEmbed from 'vue-youtube-embed'
import Vue2Editor from "vue2-editor"
import VueCarousel from '@chenfengyuan/vue-carousel'
import VueLazyLoad from 'vue-lazyload'


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
Vue.use(VueYouTubeEmbed)
Vue.use(Vue2Editor)
Vue.use(VueCarousel);
Vue.use(VueLazyLoad)

// register plugin component
Vue.component('multiselect', Multiselect);
Vue.component('tags-input', VoerroTagsInput);
Vue.component('pagination', LaravelPagination);

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('setup-instansi', require('./components/Instansi.vue').default);

//setup front end
Vue.component('home-kid', require('./front/index.vue').default);
Vue.component('video-profile', require('./front/video_profile.vue').default);
Vue.component('our-feature', require('./front/our_feature.vue').default);
Vue.component('current-promo', require('./front/current_promo.vue').default);
Vue.component('latest-news', require('./front/latest_news.vue').default);
Vue.component('founder-component', require('./front/components/founder_component.vue').default);
Vue.component('testimoni', require('./front/home/testimoni.vue').default);
Vue.component('calendar-dan-event',require('./front/home/calendar_and_event.vue').default);
Vue.component('gallery-component', require('./front/components/gallery_component.vue').default);
Vue.component('newsletter-component', require('./front/components/newsletter_component.vue').default);
Vue.component('contact-component', require('./front/components/contact_component.vue').default);
Vue.component('testimoni-component', require('./front/components/testimoni_component.vue').default);
Vue.component('program-component', require('./front/components/program_component.vue').default);
Vue.component('subscribe-component', require('./front/subscribe.vue').default);

const routes = require('./routes').default
const router = new VueRouter({ routes });
const app = new Vue({ router }).$mount('#app');
