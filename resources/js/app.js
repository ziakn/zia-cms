import Vue from 'vue'
require('./bootstrap');
window.Vue = require('vue');
import vuetify from './plugins/vuetify' // path to vuetify export
import Permissions from './mixins/Permissions';
import common from './common';


Vue.mixin(common);
import 'babel-polyfill';
require('es6-object-assign').polyfill();
require('es6-promise').polyfill();

Vue.mixin(Permissions);




Vue.use(require('vue-moment'));

import * as VueGoogleMaps from 'vue2-google-maps'
Vue.use(VueGoogleMaps, {
    load: {
        // key: 'AIzaSyA0utN-bgpJ_zRHyJr-dob3yFAXIV7TCLM&q',
        // key: 'AIzaSyBXUD3Qdhcv1VmhKB3Z4jcse6salHM-HM0',
        key: 'AIzaSyCxS4ctpxlWEkNPWZlD4sjDpWHQIF1jguE',
        libraries: 'places',
    },
    installComponents: true
})

// let userType = window.authUser.userType
// router.beforeEach((to, from, next) => {

//     var flag=0;
//     if(to.meta){
//         let allowed = to.meta.type
//         for(let a of allowed){
//             if(a==userType){                
//                 flag=1;
//             }
//         }
//     }
//     if(flag==1)
//     next();
//     else
//     return;
  
//   });



 
import CKEditor from 'ckeditor4-vue';

Vue.use( CKEditor );

router.afterEach((to, from) => {
    Vue.nextTick(() => {
        document.title = to.meta.title ? to.meta.title : 'zia';
    });
})

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import router from './router'
import store from './store/store'
Vue.component('z-dashboard', require('./components/ExampleComponent.vue').default);
const app = new Vue({
    el: '#app',
    vuetify,
    router,
    store: store,
});
