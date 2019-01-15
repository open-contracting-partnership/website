let mix = require('laravel-mix');
var path = require('path');
const SvgStore = require('webpack-svgstore-plugin');
var LiveReloadPlugin = require('webpack-livereload-plugin');

// set the public path directory
// without this an error within version orrurs
mix.setPublicPath(path.resolve('./'));

// enable versioning for all compiled files
mix.version();

mix.sass('resources/scss/styles.scss', 'dist/css')
	.options({
		processCssUrls: false
	});

// watch for any changes in styleguide.js, only when not production
if ( ! mix.inProduction() ) {

	mix.copy('node_modules/mapbox-gl/dist/mapbox-gl.css', 'resources/node_modules/mapbox-gl/mapbox-gl.css')
		.copy('node_modules/flag-icon-css/flags', 'resources/node_modules/flag-icon-css/flags');

}

mix.js('resources/js/main.js', 'dist/js')
	.js('resources/js/impact-stories.js', 'dist/js')
	.js('resources/js/get-started.js', 'dist/js')
	.js('resources/js/worldwide.js', 'dist/js')
	.js('resources/js/latest-news.js', 'dist/js')
	.js('resources/js/events.js', 'dist/js')
	.js('resources/js/archive.js', 'dist/js')
	.js('resources/js/resources.js', 'dist/js')
	.js('resources/js/svg.js', 'dist/js')
	.js('resources/js/element-queries.js', 'dist/js')
	.extract(['vue'])
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
