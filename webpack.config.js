// webpack.config.js
const VueLoaderPlugin = require('vue-loader/lib/plugin')

module.exports = env => {
    return {
        entry: {
            app_private: './app/resources/js/app_private.js',
            app_public: './app/resources/js/app_public.js'
        },
        mode: env.NODE_ENV,
        output: {
            path: __dirname + '/js/',
            filename: '[name].js'
        },
        module: {
            rules: [
                {
                    test: /\.vue$/,
                    loader: 'vue-loader'
                },
                // this will apply to both plain `.js` files
                // AND `<script>` blocks in `.vue` files
                {
                    test: /\.js$/,
                    loader: 'babel-loader'
                },
                // this will apply to both plain `.css` files
                // AND `<style>` blocks in `.vue` files
                {
                    test: /\.css$/,
                    use: [
                        'vue-style-loader',
                        'css-loader'
                    ]
                }
            ]
        },
        resolve: {
            alias: {
                //vue: 'vue/dist/vue.js'
                vue: env.NODE_ENV == 'production' ? 'vue/dist/vue.min.js' : 'vue/dist/vue.js'
            }
        },
        plugins: [
            // make sure to include the plugin for the magic
            new VueLoaderPlugin()
        ]
    }

}