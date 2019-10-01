const mix = require('laravel-mix');
const path = require('path');
const SvgStore = require('webpack-svgstore-plugin');

// watch for any changes in styleguide.js, only when not production
if ( ! mix.inProduction() ) {

	mix.js('styleguide_assets/aigis_assets/scripts/styleguide.js', 'styleguide_assets/aigis_assets/dist')
		.webpackConfig({
			module: {
				rules: [
					{
						test: /\.js$/,
						exclude: /node_modules/,
						loader: 'babel-loader',
						query: {
							plugins: ['@babel/transform-runtime'],
							presets: ['@babel/env']
						}
					},
				]
			}
		});

}

mix.sass('resources/scss/styles.scss', 'dist/css')
	.sass('styleguide_assets/aigis_assets/styles/theme.scss', 'styleguide_assets/aigis_assets/dist')
	.options({
		processCssUrls: false
	});

mix.js('resources/js/scripts.js', 'dist/js')
	.js('resources/js/svg.js', 'dist/js')
	.then((stats) => {

		if ( ! mix.inProduction() ) {

			const files = Object.keys(stats.compilation.assets);
			const trigger_files = [
				'dist/css/styles.css'
			];

			// check if any of the trigger files are in the latest compile
			const diff = files.filter(function(n) {
			    return trigger_files.indexOf(n) !== -1;
			});

			// and if they are, trigger the styleguide
			if ( diff.length ) {

				setTimeout(() => {
					const Aigis = require('node-aigis');
					const aigis = new Aigis('./styleguide_config.yml');
					aigis.run();
				}, 100);

			}

		}

	})
	.webpackConfig({
		resolve: {
			modules: [
				'node_modules'
			]
		},
		module: {
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
			})
		]
	});
