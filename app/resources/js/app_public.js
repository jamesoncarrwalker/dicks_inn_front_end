import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex';
import routes from './routes';
import store_shared from './shared/store/store';
import store_public from './public/store/store_public';

//globally register the common components
import './shared/components/register';

Vue.use(require('vue-moment'));
Vue.use(Vuex);
Vue.use(VueRouter);

const store = new Vuex.Store({...store_public.modules, ...store_shared.modules});


const app = new Vue({

    el:'#app',
    router: new VueRouter(routes),
    store: store
});