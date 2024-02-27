const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');

require('laravel-mix-svg-sprite');

// set the public path directory
mix.setPublicPath('dist');

// enable versioning for all compiled files
mix.version();

mix.copy('node_modules/mapbox-gl/dist/mapbox-gl.css', 'dist/node_modules/mapbox-gl/mapbox-gl.css');

mix.svgSprite('resources/svg', 'svg/icons.svg')

mix.sass('resources/scss/styles.scss', 'dist/css')
	.sass('resources/scss/gutenberg.scss', 'dist/css')
	.options({
		processCssUrls: false,
        postCss: [tailwindcss('./tailwind.config.js')],
	});

mix.js('resources/js/scripts.js', 'dist/js')
	.js('resources/js/element-queries.js', 'dist/js')
	.js('resources/js/block-download-carousel.js', 'dist/js')
	.js('resources/js/block-featured-stories-carousel.js', 'dist/js')
	.js('resources/js/block-our-model.js', 'dist/js')
	.js('resources/js/block-quote-carousel.js', 'dist/js')
	.js('resources/js/block-report-header.js', 'dist/js')
	.js('resources/js/block-stats.js', 'dist/js')
	.js('resources/js/block-team-profile.js', 'dist/js')
	.js('resources/js/header.js', 'dist/js')
	.js('resources/js/impact-stories.js', 'dist/js')
	.js('resources/js/latest-news.js', 'dist/js')
	.js('resources/js/archive-resource.js', 'dist/js')
	.js('resources/js/mailchimp.js', 'dist/js')
	.js('resources/js/svg.js', 'dist/js')
	.js('resources/js/modules/worldwide/worldwide.js', 'dist/js')
	.extract(['vue'])
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
