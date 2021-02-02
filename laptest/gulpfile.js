require("laravel-elixir-webpack");
var elixir = require('laravel-elixir');
//var webpackConf = require(__dirname + '/webpack.config.js');
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
    //mix.sass('app.scss');
	mix.scriptsIn('./resources/assets/js');
	/*
		mix.styles([
			'normalize.css',
			'main.css'
		], 'public/assets/css/site.css');
	*/
	
	/*
		//app/assets/js/app.js to public/dist/app.js:
		mix.webpack(
			'./app/assets/js/app.js',
			'./public/dist'
		);
	*/
	
	mix.browserSync({
        proxy: 'localhost/laptest-new/public/'
    });
	
	
});
