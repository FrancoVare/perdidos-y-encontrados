
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

window.Vue = require('vue');

window.events = new Vue();

window.flash = function(message, type) {
        window.events.$emit('flash', message, type);
    };

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 // Define a new component called button-counter

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('modal', require('./components/Modal.vue'));
Vue.component('new-materia-modal', require('./components/NewMateriaModal.vue'));
Vue.component('new-laboratorio-modal', require('./components/NewLaboratorioModal.vue'));
Vue.component('new-prueba-modal', require('./components/NewPruebaModal.vue'));
Vue.component('new-sede-modal', require('./components/NewSedeModal.vue'));
Vue.component('new-tag-modal', require('./components/NewTagModal.vue'));
Vue.component('paginate', require('vuejs-paginate'));
Vue.component('items',require('./components/Items.vue'));
Vue.component('registro',require('./components/Registro.vue'));
Vue.component('flash',require('./components/Flash.vue'));


const app = new Vue({
      el: '#app'
});

