let mix = require('laravel-mix');
var path = require('path');

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

mix.sass('resources/scss/styles.scss', 'dist/css')
	.js('resources/js/main.js', 'dist/js')
	.js('resources/js/impact-stories.js', 'dist/js')
	.js('resources/js/get-started.js', 'dist/js')
	.js('resources/js/worldwide.js', 'dist/js')
	.options({
		processCssUrls: false
	})
	.webpackConfig({
		resolve: {
			modules: [
				'node_modules'
			],
			alias: {
				'vue$': 'vue/dist/vue.js'
			}
		},
		module: {
			noParse: /(mapbox-gl)\.js$/,
			rules: [
				{
					test: /\.scss/,
					enforce: 'pre',
					loader: 'import-glob-loader'
				}
			]
		}
	});
