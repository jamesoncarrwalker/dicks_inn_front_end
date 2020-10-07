///**
// * Created by jamesskywalker on 25/09/2020.
// */
//

import Vue from 'vue';

// Globally register all base components for convenience, because they
// will be used very frequently. Components are registered using the
// PascalCased version of their file name.


// https://webpack.js.org/guides/dependency-management/#require-context

test(require.context('./shared/components', true, /[A-Z]\w+\.vue$/))
test(require.context('./splash_pages', true, /[A-Z]\w+\.vue$/))

function test(components) {
    components.keys().forEach((fileName) => {

        // Get the component config
        const componentConfig = components(fileName);

        const componentName = fileName.split('/').pop().replace(/\.\w+$/, '');

        // Globally register the component
        Vue.component(componentName, componentConfig.default || componentConfig)
    });

}
// For each matching file name...
