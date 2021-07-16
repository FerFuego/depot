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
   /*  .styles([
        'resources/vendor/fontawesome-free-5.15.1-web/css/all.min.css',
        'resources/css/adminlte.min.css',
        'resources/css/ionicons.min.css',
        'resources/css/bootstrap-tagsinput.css',
        'resources/css/bootstrap-select.css',
        'resources/css/icheck-bootstrap.min.css',
        'resources/css/bootstrap-datetimepicker.css',
        'resources/css/bootstrap-duallistbox.min.css',
        'resources/vendor/datatables-bs4/css/dataTables.bootstrap4.min.css',
        'resources/vendor/datatables-responsive/css/responsive.bootstrap4.min.css',
        'resources/css/app.css'
    ], 'public/css/app.css')
 */
    .js('resources/js/app.js', 'public/js')

    .scripts([
        'resources/vendor/jquery/jquery.js',
        'resources/vendor/jquery-ui/jquery-ui.js',
        'resources/vendor/moment/moment.js',
        'resources/js/adminlte.js',
        'resources/vendor/bootstrap/js/bootstrap.bundle.js',
        'resources/vendor/bootstrap/js/bootstrap.tagsinput.js',
        'resources/vendor/bootstrap/js/bootstrap-select.js',
        'resources/vendor/bootstrap/js/bootstrap-datetimepicker.js',
        'resources/vendor/bootstrap/js/bootstrap.duallistbox.js',
        'resources/vendor/datatables/jquery.dataTables.js',
        'resources/vendor/datatables-bs4/js/dataTables.bootstrap4.js',
        'resources/vendor/datatables-responsive/js/dataTables.responsive.js',
        'resources/vendor/datatables-responsive/js/responsive.bootstrap4.js',
        'resources/js/custom-scripts.js'
    ], 'public/js/vendor.js')

    .copy('resources/vendor/fontawesome-free-5.15.1-web/webfonts', 'public/webfonts')

    .copy('resources/img', 'public/img')

    .version()
;