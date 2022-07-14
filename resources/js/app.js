/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');



import VueRouter from 'vue-router'
Vue.use(VueRouter)

//import Gate class --permission
import Gate from './Gate'
Vue.prototype.gate=new Gate(window.user);

import Swal from 'sweetalert2'
window.Swal=Swal


import VueProgressBar from 'vue-progressbar'

Vue.use(VueProgressBar, {
  color: 'rgb(143, 255, 199)',
  failedColor: 'red',
  height: '8px'
})

import QrcodeVue from 'qrcode.vue'

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('pagination', require('laravel-vue-pagination'));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const routes = [

    { path: '/users', component: require('./components/users.vue').default, name:'users'},
    { path: '/brigades', component: require('./components/brigades.vue').default, name:'brigades'},
    { path: '/communes', component: require('./components/communes.vue').default, name:'communes'},
    { path: '/configurations', component: require('./components/configuration.vue').default, name:'configuration'},
    { path: '/grades', component: require('./components/grades.vue').default, name:'grades'},
    { path: '/infractions', component: require('./components/infractions.vue').default, name:'infractions'},
    { path: '/resultats', component: require('./components/resultats.vue').default, name:'resultats'},
    { path: '/services', component: require('./components/services.vue').default, name:'services'},
    { path: '/exercices', component: require('./components/exercices.vue').default, name:'exercices'},

    { path: '/commercants', component: require('./components/commercants.vue').default, name:'commercants'},
    { path:'/activites', component:require('./components/activites.vue').default, name:'activites'},
    { path :'/activitescom', component:require('./components/activite_com.vue').default, name:'activite_com'},
    { path:'/adressescom', component:require('./components/adresse_com.vue').default, name:'adresse_com'},

    { path:'/pvs', component:require('./components/pvs.vue').default, name:'pvs'},
    { path:'/pvsCreate', component:require('./components/pvsCreate.vue').default,props:true, name:'pvsCreate'},
    { path:'/commercantPvs/:commercant_id', component:require('./components/pvs.vue').default, name:'commercantPvs'},
    { path:'/modelRedaction', component:require('./components/model_redaction.vue').default, name:'model_redaction'},


    {path:'/typesaisies',component:require('./components/typesaisies.vue').default, name:'typesaisies'},
    {path:'/categories', component:require('./components/categories.vue').default,name:'categories'},
    {path:'/products',component:require('./components/products.vue').default, name:'products'},


    {path:'/pvsPrint/:pv_id',component:require('./components/pvsPrint.vue').default,name:'pvsPrint'},
    {path:'/ordreVerssement/:pv_id',component:require('./components/ordreVerssement.vue').default,name:'ordreVerssement'},
    {path:'/pvSaisie/:pv_id',component:require('./components/pvSaisie.vue').default, name:'pvSaisie'},

    {path:'/tsaisies', component:require('./components/tsaisies.vue').default, name:'tsaisies'},

    {path:'/statistiques', component:require('./components/statistiques.vue').default, name:'statistiques'},
  ]

  const router = new VueRouter({
    routes // short for `routes: routes`
  })

const app = new Vue({
    el: '#app',
    router
});
