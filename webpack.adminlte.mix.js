const mix = require('laravel-mix')
const WebpackRTLPlugin = require('webpack-rtl-plugin');

require('laravel-mix-merge-manifest');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.copyDirectory('node_modules/admin-lte/dist/img', 'public/images');

mix.js('resources/js/adminlte/adminlte.js', 'public/js')
    .sass('resources/sass/adminlte/adminlte.scss', 'public/css')
    .vue();

// Handle rtl
mix.webpackConfig({
    plugins: [
        new WebpackRTLPlugin({
            diffOnly: false,
            minify: true,
        }),
    ],
});

mix.mergeManifest();
mix.version();
