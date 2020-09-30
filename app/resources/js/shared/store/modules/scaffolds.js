/**
 * Created by jamesskywalker on 05/03/2020.
 */

export default {
    namespaced:true,
    state: {

    },

    getters: {
        getFullWidthClasses: () => 'col-xs-12 col-sm-12 col-md-12 col-lg-12',

        getHalfWidthClasses: () => 'col-xs-6 col-sm-6 col-md-6 col-lg-6',

        getThirdWidthClasses: () => 'col-xs-3 col-sm-3 col-md-3 col-lg-3',

        getFullLgHalfWidthSmClasses: () => 'col-xs-6 col-sm-6 col-md-12 col-lg-12'
    }
}