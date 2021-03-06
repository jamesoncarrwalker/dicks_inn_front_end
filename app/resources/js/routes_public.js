/**
 * Created by jamesskywalker on 04/03/2020.
 */

/**
 * Created by jamesskywalker on 04/03/2020.
 */

import Landing from './public/pages/Landing.vue';
import SignIn from './public/pages/SignIn.vue';
import Register from './public/pages/Register.vue';
import Guest from './public/pages/Guest.vue';

const base = appEnv.BASE_URL;

export default {

    mode:'history',
    linkActiveClass: 'strong',

    routes: [
        {
            path: base + '/',
            component: Landing,
            name: 'landing'
        }
        ,{
            path:base + 'sign-in',
            component: SignIn,
            name: 'sign-in'

        }
        ,{
            path: base + 'register',
            component: Register,
            name: 'register'
        }
        ,{
            path: base + 'guest',
            component: Guest,
            name: 'guest'
        }
    ]
};