
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

//require('./dynamical-dropdown');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('vue-pagination', require('./components/Pagination.vue'));

Vue.component('location-form', require('./components/location/Form.vue'));

Vue.component('file-upload',require('./components/FileUpload.vue'));

Vue.component('file-input', require('./components/FileInput.vue'));
Vue.component('form-upload', require('./components/FormUpdate.vue'));

const app = new Vue({
    el: '#image-form-wrapper'
});