
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

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 // Define a new component called button-counter
 

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('modal', require('./components/Modal.vue'));
Vue.component('new-materia-modal', require('./components/NewMateriaModal.vue'));
Vue.component('paginate', require('vuejs-paginate'));
Vue.component('items',require('./components/Items.vue'));


const app = new Vue({
      el: '#app',
	  data: {
	    showModal: false,
	    showNewMateriaModal: false
	  }
});



$(function() {
   $('#flash-message').delay(250).fadeIn('normal', function() {
      $(this).delay(5000).fadeOut();
   });
});


