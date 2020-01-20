const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/theme/AdminLTE.js', 'public/js/adminlte.js')
    .sass('resources/sass/AdminLTE.scss', 'public/css/app.css')
    .copyDirectory('resources/plugins', 'public/plugins')
    .version();

mix.copyDirectory('resources/images', 'public/images');


