const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/*.js', 'public/js/app.js')
    .js('resources/js/pages/*.js', 'public/js/app.js')
    .sass('resources/sass/app.scss', 'public/css')
    .copy('resources/img', 'public/img')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ])
    .sourceMaps();

mix.combine([
    'node_modules/jquery/dist/jquery.min.js',
    'node_modules/bootstrap/dist/js/bootstrap.bundle.js'
], 'public/js/modules.js');

mix.styles([
    'node_modules/bootstrap/dist/css/bootstrap.css',
], 'public/css/modules.css');

// mix.js('resources/js/app.js', 'public/js')
//     .sass('node_modules/bootstrap/scss/bootstrap.scss', 'public/css')
//     .js('node_modules/bootstrap/dist/js/bootstrap.bundle.js', 'public/js')
//     .js('resources/js/pages/*.js', 'public/js/custom.js')
//     .sass('resources/sass/app.scss', 'public/css')
//     .copy('resources/img', 'public/img')
//     .postCss('resources/css/app.css', 'public/css', [
//         //
//     ]);
