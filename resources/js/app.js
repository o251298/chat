/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;
import Vue from 'vue'
import Toaster from 'v-toaster'
// You need a specific loader for CSS files like https://github.com/webpack/css-loader
import 'v-toaster/dist/v-toaster.css'
// optional set default imeout, the default is 10000 (10 seconds).
Vue.use(Toaster, {timeout: 5000})
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('laravel-component', require('./components/LaravelComponent.vue').default);
Vue.component('line-component', require('./components/LineChart.vue').default);
Vue.component('pie-component', require('./components/PieChart.vue').default);
Vue.component('socket-chart', require('./components/SocketChart.vue').default);
Vue.component('socket-chat', require('./components/SocketChat.vue').default);
Vue.component('private-chat', require('./components/PrivateChat.vue').default);
Vue.component('chat-user', require('./components/ChatUser.vue').default);
Vue.component('toast-component', require('./components/ToastComponent.vue').default);
Vue.component('chat-component', require('./components/v1/ChatComponent').default);
Vue.component('create-post', require('./components/v1/CreatePost').default);
Vue.component('user-post', require('./components/v1/UserCreatePost').default);
Vue.component('post-component', require('./components/v1/Post').default);
Vue.component('comment-component', require('./components/v1/CommentComponent').default);
Vue.component('create-comment', require('./components/v1/CreateComment').default);
Vue.component('track-component', require('./components/v1/TrackMessages').default);
Vue.component('news-paginate', require('./components/lessons/NewsPaginate').default);
Vue.component('post-create', require('./components/lessons/CreatePost').default);
Vue.component('like-component', require('./components/lessons/LikeComponent').default);
Vue.component('captcha-component', require('./components/v1/CaptchaComponent').default);
Vue.component('smsclub-component', require('./components/smsclub').default);
Vue.component('save-modal', require('./components/v1/news/SaveModal').default);
Vue.component('search-component', require('./components/v1/SearchComponent').default);
Vue.component('popup-component', require('./components/popups/v-popup').default);
Vue.component('modal-component', require('./components/popups/ModalComponent').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
