let mix = require('laravel-mix');
var path = require('path');
const SvgStore = require('webpack-svgstore-plugin');
var LiveReloadPlugin = require('webpack-livereload-plugin');

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
	.js('resources/js/svg.js', 'dist/js')
	.copy('node_modules/mapbox-gl/dist/mapbox-gl.css', 'dist/css/mapbox-gl.css')
	.copy('node_modules/flag-icon-css/flags', 'dist/img/flags')
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
		},
		plugins: [
			new SvgStore({
				prefix: ''
			}),
			new LiveReloadPlugin()
		]
	});
