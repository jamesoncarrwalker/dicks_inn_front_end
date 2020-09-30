/**
 * Created by jamesskywalker on 04/03/2020.
 */

/**
 * Created by jamesskywalker on 04/03/2020.
 */


//import Wall from './components/Wall';
//import Welcome from './components/Welcome';
//import Connections from './components/Connections';
import Landing from './shared/pages/Landing.vue';

export default {
    mode:'history',
    linkActiveClass: 'strong',

    routes: [
        {
            path:'*',
            component: Landing
        }
        //,{
        //    path:'/',
        //    component: Welcome,
        //    name: 'home'
        //
        //}
        //,{
        //    path:'/wall',
        //    component: Wall,
        //    name: 'wall'
        //}
        //,{
        //    path:'/connections',
        //    component: Connections,
        //    name: 'connections'
        //}
    ]
};