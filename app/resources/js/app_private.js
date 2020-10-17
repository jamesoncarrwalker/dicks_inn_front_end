import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex';
import routes from './routes_private';
import store_shared from './shared/store/store';
import store_private from './private/store/store_private';
import axios from 'axios'


//globally register the common components
import './global_register';

Vue.use(require('vue-moment'));
Vue.use(Vuex);
Vue.use(VueRouter);
Vue.prototype.$axios = axios;

const store = new Vuex.Store({...store_private.modules, ...store_shared.modules});


const app = new Vue({

    el:'#dash',
    router: new VueRouter(routes),
    store: store
});