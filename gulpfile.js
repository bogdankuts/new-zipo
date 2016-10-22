const elixir = require('laravel-elixir');

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
	mix.sass('./resources/assets/sass/user-interface/style.scss', 'public/css/user-interface/style.css');
	mix.sass('./resources/assets/sass/admin/style.scss', 'public/css/admin/style.css');
});