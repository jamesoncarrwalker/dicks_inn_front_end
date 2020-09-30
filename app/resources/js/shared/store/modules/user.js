export default {
    namespaced:true,
    state: {
        lastLoginCheck: null,
        id: null,
        authLevel: null
    },

    getters: {

        getLastLoginCheck: state => state.lastLoginCheck,

        getId: state => state.id,

        isLoggedIn: state => (state.lastLoginCheck !== null && moment().diff(state.lastLoginCheck,'minutes') < 15),

    },

    actions: {
        setLastLoginCheck({commit}) {
            commit('SET_LAST_LOGIN',payload);
        },
    },

    mutations: {
        SET_LAST_LOGIN(state) {
            state.lastLoginCheck = moment().format('MMMM Do YYYY, h:mm:ss');
        },
    }
}