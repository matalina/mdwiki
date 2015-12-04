var elixir = require('laravel-elixir');

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

elixir(function(mix) {
    // Sass Files
    mix.sass([
        'foundation-sites.scss'
    ]);
    mix.scripts([
        'vendor/jquery.js',
        'foundation.js',
        'script.js'
    ]);
});
