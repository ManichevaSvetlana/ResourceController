require('./bootstrap');
/* Import dependencies */
import Vue from 'vue'
import Notifications from 'vue-notification' // design: notifications
import Antd from 'ant-design-vue' // ant design: for decorating the app
import 'ant-design-vue/dist/antd.css' // ant design stylesheet
import router from './router'

import store from './store' // vuex store
import User from './store/models/User'; // user model
/* End of import dependencies */
/* Import components */
import App from './components/App.vue'
/* End of import components */
/* Setting User from local storage */
let user = localStorage.getItem('auth__user');
if(user) {
    user = JSON.parse(user);
    User.create({
        data: user
    })
}
/* End of setting user */
window.Vue = require('vue');

Vue.use(Antd)
Vue.use(Notifications)
/* Registering components */
Vue.component('vue-app', require('./components/App.vue').default);

Vue.component('resources-table', require('./components/app/resources/resource/Table').default);
Vue.component('resources-view', require('./components/app/resources/resource/ResourcesView').default);
/* End of registering components */

/*
* Notify the user about the error
* @return void
*/
Vue.prototype.$notifyError = function(error){
    const {response, message} = error;
    const defaultError = 'We caught an error. Try again.';
    this.$notify({
        group: 'notif',
        text: message || defaultError,
        type: 'error',
    });
};

const app = new Vue({
    el: '#app',
    components: { App },
    router, store,
});


