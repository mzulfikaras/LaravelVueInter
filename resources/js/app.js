require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import VueAxios from 'vue-axios';
import axios from 'axios';

import App from './App.vue';
Vue.use(VueAxios, axios);

import IndexComponent from './components/posts/Index.vue';
import CreateComponet from './components/posts/Create.vue';
import EditComponet from './components/posts/Edit.vue';

const routes = [
    {
        name: 'posts',
        path: '/',
        component: IndexComponent,
    },
    {
        name: 'create',
        path: '/create',
        component: CreateComponet,
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: EditComponet,
    }
];

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

const app = new Vue (Vue.util.extend({ router }, App)).$mount('#app');