/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import {TinkerComponent} from 'botman-tinker';

Vue.component('botman-tinker', TinkerComponent);

Vue.component('flash', require('./components/Flash.vue').default);
Vue.component('sidebar', require('./components/Sidebar.vue').default);
Vue.component('category-item-view', require('./components/CategoryView').default);
Vue.component('category-item-detail-view', require('./components/CategoryDetailView').default);
Vue.component('item-view', require('./components/ItemView').default);
Vue.component('message-view', require('./components/MessageView.vue').default);
Vue.component('question-create', require('./pages/NewQuestion.vue').default);

const app = new Vue({
    el: '#eshangazi'
});