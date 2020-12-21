require('./bootstrap.js');
require('./owl.carousel.min.js');
require('./jquery-3.5.1.min.js');
require('./jquery.magnify.js');
require('./star-rating.min.js');
require('./select2.full.min');
require('./flash.min.js');

// require('./vue-flash-message.min.js');
import VueFlashMessage from 'vue-flash-message';


/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


window.Vue = require('vue');

// Vue.use(VueFlashMessage);

Vue.use(VueFlashMessage, {
    messageOptions: {
        timeout: 3000,
        important: false,
        autoEmit: true,
        pauseOnInteract: true
    }
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app',
// });

$(document).ready(function() {
    $('.js-example-basic-single').select2({
        placeholder: "لطفا انتخاب کنید . .",
        allowClear: true
    });
});

