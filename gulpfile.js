const elixir = require('laravel-elixir');

// require('laravel-elixir-vue');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(mix => {
    mix.sass('app.sass')
       .webpack('app.js');

    mix.copy('node_modules/bootstrap-sass/assets/fonts/bootstrap','public/fonts/bootstrap')
       .copy('node_modules/ace-editor-builds/src-min-noconflict', 'public/js/ace');
});
