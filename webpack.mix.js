const mix = require('laravel-mix');
const webpack = require('webpack');

const STYLE_TARGET_PATH = 'public/static/css';
const SCRIPT_TARGET_PATH = 'public/static/js';

const MODULES = __dirname + '/node_modules/';
const ASSETS_TARGET = 'public/static/assets/';

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

mix.browserSync({
    proxy: 'http://project-franco.local/',
    open: false,
});

mix.webpackConfig({
    externals: {
        jquery: 'jQuery',
        'popper.js': 'Popper',
    }
});



mix.sass('src/scss/core.scss', STYLE_TARGET_PATH);
mix.sass('src/scss/login.scss', STYLE_TARGET_PATH);
mix.sass('src/scss/register.scss', STYLE_TARGET_PATH);
mix.sass('src/scss/admin.scss', STYLE_TARGET_PATH);
mix.sass('src/scss/admin/dashboard.scss', STYLE_TARGET_PATH + '/admin');
mix.sass('src/scss/admin/profile.scss', STYLE_TARGET_PATH + '/admin');

// JAVASCRIPT
mix.js('src/js/app.js', SCRIPT_TARGET_PATH + '/');
mix.js('src/js/register.js', SCRIPT_TARGET_PATH + '/');

mix.copyDirectory(MODULES + 'bootstrap-icons/font', ASSETS_TARGET + 'bootstrap-icons');

mix.copy(MODULES + 'jquery/dist/jquery.min.js', ASSETS_TARGET + 'jquery')
    .copy(MODULES + 'popper.js/dist/umd/popper.min.js', ASSETS_TARGET + 'popper');

mix.disableSuccessNotifications();
