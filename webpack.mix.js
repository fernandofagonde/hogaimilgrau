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

 // Admin Sass
 mix.sass('resources/sass/admin/main.scss', 'public/assets/css/admin/main.css')

 // Admin CSS
 .copy('resources/css/admin/quill.snow.css', 'public/assets/css/admin/quill.snow.css')

 // Color JS
 .js([
    'resources/js/admin/color.js',
 ], 'public/assets/js/admin/color.min.js')

 // Glightbox JS
 .js([
    'resources/js/admin/glightbox.js',
 ], 'public/assets/js/admin/glightbox.min.js')

 // Charts JS
 .js([
    'resources/js/admin/charts.js',
 ], 'public/assets/js/admin/charts.min.js')

 // Quill JS
 .copy(
    [
        'resources/js/admin/quill.min.js',
        'resources/js/admin/quill.resize.min.js'
    ],
'public/assets/js/admin')

// Admin Lib
.copyDirectory(
    'resources/js/admin/lib',
    'public/assets/js/admin/lib')

 // Glightbox JS
 .js([
    'resources/js/app/glightbox.js',
 ], 'public/assets/js/app/glightbox.min.js')

 // Charts JS
 .js([
    'resources/js/app/charts.js',
 ], 'public/assets/js/app/charts.min.js')

 // Quill JS
 .copy(
    [
        'resources/js/app/quill.min.js',
        'resources/js/app/quill.resize.min.js'
    ],
'public/assets/js/app')

// Admin Lib
.copyDirectory(
    'resources/js/app/lib',
    'public/assets/js/app/lib')

// Admin Modules
.copyDirectory(
    'resources/js/app/modules',
    'public/assets/js/app/modules')

 .version();

// Register Quill Plugin
 mix.webpackConfig(webpack => {
    return {
        plugins: [
            new webpack.ProvidePlugin({
                'window.Quill': 'quill',
                'Quill': 'quill'
            })
        ]
    };
});
