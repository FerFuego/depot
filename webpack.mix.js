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

mix
    .styles([
        'resources/vendor/fontawesome-free-5.15.1-web/css/all.min.css',
        'resources/css/adminlte.min.css',
        'resources/css/ionicons.min.css',
        'resources/css/bootstrap-tagsinput.css'
    ], 'public/css/app.css')

    .js('resources/js/app.js', 'public/js')

    .scripts([
        'resources/vendor/jquery/jquery.min.js',
        'resources/vendor/bootstrap/js/bootstrap.bundle.min.js',
        'resources/vendor/bootstrap/js/bootstrap.tagsinput.js'
    ], 'public/js/vendor.js')

    .copy('resources/vendor/fontawesome-free-5.15.1-web/webfonts', 'public/webfonts')

    .copy('resources/img', 'public/img')

    .version()
;