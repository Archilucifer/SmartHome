const mix = require('laravel-mix');

const VuetifyLoaderPlugin = require('vuetify-loader/lib/plugin')

const webpackConf = {
    plugins: [
        new VuetifyLoaderPlugin(),
    ]
};

mix.webpackConfig(webpackConf);

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');
