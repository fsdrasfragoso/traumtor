const mix = require("laravel-mix");
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

mix.disableNotifications();

// admin
mix.js("resources/assets/admin/js/app.js", "public/js/admin")
    .sass("resources/assets/admin/sass/app.scss", "public/css/admin")
    .copy("resources/assets/admin/img", "public/img/admin");

// frontend
mix.js("resources/assets/frontend/js/app.js", "public/js/frontend")
    .sass("resources/assets/frontend/sass/app.scss", "public/css/frontend")
    .copy("resources/assets/frontend/img", "public/img/frontend");

mix.sass(
    "resources/assets/frontend/sass/app-ckeditor.scss",
    "public/css/frontend"
);

mix.version();
