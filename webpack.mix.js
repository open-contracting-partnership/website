const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');

require('laravel-mix-svg-sprite');

// set the public path directory
mix.setPublicPath('dist');

// enable versioning for all compiled files
mix.version();

mix.copy('node_modules/mapbox-gl/dist/mapbox-gl.css', 'dist/node_modules/mapbox-gl/mapbox-gl.css');

// watch for any changes in styleguide.js, only when not production
if ( ! mix.inProduction() ) {

	mix.js('styleguide_assets/aigis_assets/scripts/styleguide.js', 'styleguide')
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

mix.svgSprite('resources/svg', 'svg/icons.svg')

mix.sass('resources/scss/styles.scss', 'dist/css')
	.sass('resources/scss/gutenberg.scss', 'dist/css')
	.sass('styleguide_assets/aigis_assets/styles/theme.scss', 'styleguide')
	.options({
		processCssUrls: false,
        postCss: [tailwindcss('./tailwind.config.js')],
	});

mix.js('resources/js/scripts.js', 'dist/js')
	.js('resources/js/block-download-carousel.js', 'dist/js')
	.js('resources/js/block-featured-stories-carousel.js', 'dist/js')
	.js('resources/js/block-our-model.js', 'dist/js')
	.js('resources/js/block-quote-carousel.js', 'dist/js')
	.js('resources/js/block-team-profile.js', 'dist/js')
	.js('resources/js/card-quote.js', 'dist/js')
	.js('resources/js/header.js', 'dist/js')
	.js('resources/js/impact-stories.js', 'dist/js')
	.js('resources/js/latest-news.js', 'dist/js')
	.js('resources/js/archive-resource.js', 'dist/js')
	.js('resources/js/mailchimp.js', 'dist/js')
	.js('resources/js/svg.js', 'dist/js')
	.js('resources/js/modules/worldwide/worldwide.js', 'dist/js')
	.extract(['vue'])
	.then((stats) => {

		if ( ! mix.inProduction() ) {

			const files = Object.keys(stats.compilation.assets);
			const trigger_files = [
				'/css/styles.css'
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
				},
				{
					test: /\.js/,
					enforce: 'pre',
					loader: 'import-glob-loader'
				}
			]
		}
	});
