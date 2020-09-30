///**
// * Created by jamesskywalker on 25/09/2020.
// */
//

import Vue from 'vue';

// Globally register all base components for convenience, because they
// will be used very frequently. Components are registered using the
// PascalCased version of their file name.


// https://webpack.js.org/guides/dependency-management/#require-context
const requireComponent = require.context(
    // Look for files in the current directory
    '.',
    // Do not look in subdirectories
    true,
    // Only include "_base-" prefixed .vue files
    /[A-Z]\w+\.vue$/
);


// For each matching file name...
requireComponent.keys().forEach((fileName) => {

    // Get the component config
    const componentConfig = requireComponent(fileName);

    const componentName = fileName.split('/').pop().replace(/\.\w+$/, '');

    // Globally register the component
     Vue.component(componentName, componentConfig.default || componentConfig)
});
