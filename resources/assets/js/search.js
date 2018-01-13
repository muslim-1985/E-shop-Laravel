require('./bootstrap');

window.Vue = require('vue');

Vue.component('search', require('./components/Search.vue'));

const search = new Vue({
    el: '#search'
});