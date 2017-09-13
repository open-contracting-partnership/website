var gulp = require('gulp'),

	// general
	fs = require('fs'),
	watch = require('gulp-watch'),
	livereload = require('gulp-livereload'),
	rename = require('gulp-rename')
	concat = require('gulp-concat'),
	notify = require("gulp-notify"),
	browserSync = require('browser-sync').create(),
	plumber = require('gulp-plumber'),
	modernizr = require('gulp-modernizr'),
	svgstore = require('gulp-svgstore'),
	svgmin = require('gulp-svgmin'),

	// styles
	sass = require('gulp-sass'),
	scsslint = require('gulp-scss-lint'),
	autoprefixer = require('gulp-autoprefixer'),
	minifyCss = require('gulp-minify-css'),
	globbing = require('gulp-css-globbing'),

	// scripts
	uglify = require('gulp-uglify'),

	// webpack
	runSequence = require('run-sequence'),
	webpack = require('webpack-stream'),

	// styleguide
	aigis = require('gulp-aigis');


 //**************
// ERROR HANDLER

function onError(err) {
	console.log(err);
	notify().write(err)
	this.emit('end');
};


 //******
// TASKS

gulp.task('compile-styleguide', function() {
	return gulp.src('./styleguide_assets/aigis_assets/scripts/styleguide.js')
		.pipe(webpack({
			module: {
				loaders: [
					{
						test: /\.js$/,
						exclude: /node_modules/,
						loader: 'babel-loader',
						query: {
							plugins: ['transform-runtime'],
							presets: ['es2015'],
						}
					},
				]
			},
			entry: {
				styleguide: ['babel-polyfill', './styleguide_assets/aigis_assets/scripts/styleguide.js'],
			},
			output: {
				filename: '[name].js',
			},
		}))
		.pipe(gulp.dest('./styleguide_assets/aigis_assets/dist/'))
		.pipe(notify("Styleguide Assets Compiled"));
});

gulp.task('build-styleguide', function() {
	return gulp
		.src('./styleguide_config.yml')
		.pipe(aigis())
		.pipe(notify("Styleguide Generated"));
});

gulp.task('styleguide', function() {
	if ( fs.existsSync('./assets/css') ) {
		runSequence('compile-styleguide', 'build-styleguide');
	} else {
		console.log('\x1b[31m%s\x1b[0m', '\n ABORTED: directory "/assets/css" does not exist');
		console.log(' Run `yarn run build` to first compile project assets \n');
	}
});

gulp.task('svgstore', function () {
	return gulp
		.src('assets/img/icons/*.svg')
		.pipe(svgmin())
		.pipe(svgstore({ inlineSvg: true }))
		.pipe(gulp.dest('assets/img/'));
});

gulp.task('modernizr', function() {
  gulp.src(['assets/js/main.js', 'assets/css/styles.css'])
	.pipe(modernizr({ options: [
		"setClasses",
		"addTest",
		"html5printshiv",
		"testProp",
		"fnBind"
	] }))
	.pipe(uglify())
	.pipe(gulp.dest("assets/js/libs/"))
});

gulp.task('scss', function () {

	return gulp.src('./assets/scss/*.scss')
		.pipe(plumber({ errorHandler: onError }))
		.pipe(globbing({ extensions: ['.scss'] }))
		.pipe(sass())
		.pipe(autoprefixer('last 2 versions'))
		.pipe(gulp.dest('assets/css'))
		.pipe(concat('styles.min.css'))
		.pipe(minifyCss({compatibility: 'ie8'}))
		.pipe(gulp.dest('assets/css'))
		.pipe(livereload())
		.pipe(notify("Sass Compiled"));

});

gulp.task('scss-lint', function lintCssTask() {
	const gulpStylelint = require('gulp-stylelint');

	return gulp
		.src('assets/scss/**/*.scss')
		.pipe(gulpStylelint({
			reporters: [
				{formatter: 'string', console: true}
			]
		}));
});

gulp.task('js', function(done) {

	// lint, webpack and uglify the main scripts file
	return gulp.src('./assets/js/script.js')
		.pipe(plumber({ errorHandler: onError }))
		.pipe(webpack(require('./webpack.config.js')))
		.pipe(gulp.dest('./dist/js/'))
		.pipe(notify('JS Compiled'));

});


gulp.task('scss:bs', function () {

	return gulp.src('./assets/scss/*.scss')
		.pipe(plumber({ errorHandler: onError }))
		.pipe(globbing({ extensions: ['.scss'] }))
		.pipe(sass())
		.pipe(autoprefixer('last 2 versions'))
		.pipe(gulp.dest('assets/css'))
		.pipe(browserSync.reload({stream: true}))
		.pipe(concat('styles.min.css'))
		.pipe(minifyCss({compatibility: 'ie8'}))
		.pipe(gulp.dest('assets/css'))
		.pipe(livereload())
		.pipe(notify("Sass Compiled"));

});

gulp.task('bs', function () {

	browserSync.init({
		proxy: "dev.frontendboilerplate.com",
		host: "localhost"
	});

	gulp.watch('assets/scss/**/*.scss', ['scss:bs', 'scss-lint', 'modernizr']);
	gulp.watch("./*.html").on('change', browserSync.reload);

});

gulp.task('styles', function() {
	runSequence('scss', 'styleguide');
});


 //******
// WATCH

gulp.task('default', ['watch']);

gulp.task('watch', function () {

	livereload.listen();

	// boilerplate
	gulp.watch('assets/img/icons/*.svg', ['svgstore']);
	gulp.watch('assets/scss/**/*.scss', ['styles']);

	gulp.watch('assets/js/**/*.js', ['js']);
	gulp.watch('assets/js/**/*.vue', ['js']);


});

gulp.task('post-deploy', ['scss', 'js', 'svgstore', 'modernizr']);
