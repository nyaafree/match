/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// let axios = require('axios');
import axios from 'axios';

axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
};
window.Vue = require('vue');

// window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('item-area',require('./components/ItemArea.vue').default);
Vue.component('comment-area',require('./components/CommentArea.vue').default);
Vue.component('applicant-comments',require('./components/comments/ApplicantComments.vue').default);
Vue.component('proposer-comments',require('./components/comments/ProposerComments.vue').default);
Vue.component('mypage-area',require('./components/MypageArea.vue').default);
Vue.component('my-items',require('./components/mypage/MyItems.vue').default);
Vue.component('apply-items',require('./components/mypage/ApplyItems.vue').default);
Vue.component('item-form',require('./components/ItemForm.vue').default);
Vue.component('item-edit', require('./components/ItemEdit.vue').default);
Vue.component('public-messages', require('./components/mypage/PublicMessages.vue').default);
Vue.component('direct-messages', require('./components/mypage/DirectMessage.vue').default);
Vue.component('show-profile', require('./components/showProfile.vue').default);
Vue.component('message-area', require('./components/messageArea.vue').default);
Vue.component('applicant-message', require('./components/messages/ApplicantMessage.vue').default);
Vue.component('proposer-message',require('./components/messages/ProposerMessage.vue').default);
Vue.component('item-component', require('./components/items/itemComponent.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */



const app = new Vue({
    el: '#app',


});
