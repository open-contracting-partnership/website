const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');

require('laravel-mix-svg-sprite');

// set the public path directory
mix.setPublicPath('dist');

// enable versioning for all compiled files
mix.version();

mix.copy('node_modules/mapbox-gl/dist/mapbox-gl.css', 'dist/node_modules/mapbox-gl/mapbox-gl.css');

mix.svgSprite('resources/svg', 'svg/icons.svg')

mix.options({
    processCssUrls: false,
    postCss: [tailwindcss('./tailwind.config.js')],
});

mix.webpackConfig({
    resolve: {
        modules: [
            'node_modules'
        ]
    },
    module: {
        rules: [
            {
                test: /\.scss/,
                use: 'import-glob-loader'
            },
            {
                test: /\.js/,
                use: 'import-glob-loader'
            }
        ]
    }
});

mix.extract(['vue']);

mix
    .js('resources/js/archive-resource.js', 'dist/js')
    .js('resources/js/block-download-carousel.js', 'dist/js')
    .js('resources/js/block-featured-stories-carousel.js', 'dist/js')
    .js('resources/js/block-our-model.js', 'dist/js')
    .js('resources/js/block-quote-carousel.js', 'dist/js')
    .js('resources/js/block-stats.js', 'dist/js')
    .js('resources/js/block-team-profile.js', 'dist/js')
    .js('resources/js/block-timeline.js', 'dist/js')
    .js('resources/js/block-where-we-work.js', 'dist/js')
    .js('resources/js/element-queries.js', 'dist/js')
    .js('resources/js/header.js', 'dist/js')
    .js('resources/js/impact-stories.js', 'dist/js')
    .js('resources/js/mailchimp.js', 'dist/js')
    .js('resources/js/modules/worldwide/worldwide.js', 'dist/js')
    .js('resources/js/scripts.js', 'dist/js')
    .js('resources/js/scroll-prompt.js', 'dist/js')
    .js('resources/js/svg.js', 'dist/js')
    .vue()
    .sass('resources/scss/gutenberg.scss', 'dist/css')
    .sass('resources/scss/styles.scss', 'dist/css')
