import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex';
import routes from './routes';
import store_shared from './shared/store/store';
import store_private from './private/store/store_private';



Vue.use(require('vue-moment'));
Vue.use(Vuex);
Vue.use(VueRouter);
const modules = {...store_private.modules, ...store_shared.modules};

const store = new Vuex.Store({

    modules: {
        ...modules
    }

});

const app = new Vue({

    el:'#dash',
    router: new VueRouter(routes),
    store: store
});