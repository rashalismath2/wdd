
require('./bootstrap');

window.Vue = require('vue');


//Router
import VueRouter from 'Vue-router';
import Routes from './route.js';

Vue.use(VueRouter);
const router = new VueRouter({
    routes:Routes,
    mode:'history'
})

window.$ = require('jquery')
window.JQuery = require('jquery')

import VueResource from 'Vue-resource';
Vue.use(VueResource)

//admin
import Admin from './components/admin/admin.vue';
Vue.component('admin',Admin);


//Filters
Vue.filter('format-name',function(data){
    return data.toLowerCase().charAt(0).toUpperCase()+data.slice(1);
})

Vue.filter('schedulestatus',function(data){
    return (data==false) ? 'Permenent' : 'For the day';
})



const app = new Vue({
    el: '#app',
    router:router
});

