var gulp = require('gulp'),

	// general
	fs = require('fs'),
	watch = require('gulp-watch'),
	notify = require("gulp-notify"),
	plumber = require('gulp-plumber'),
	svgstore = require('gulp-svgstore'),
	svgmin = require('gulp-svgmin'),

	// webpack
	runSequence = require('run-sequence'),
	// webpack = require('webpack-stream'),

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

// gulp.task('compile-styleguide', function() {
// 	return gulp.src('./styleguide_resources/aigis_resources/scripts/styleguide.js')
// 		.pipe(webpack({
// 			module: {
// 				loaders: [
// 					{
// 						test: /\.js$/,
// 						exclude: /node_modules/,
// 						loader: 'babel-loader',
// 						query: {
// 							plugins: ['transform-runtime'],
// 							presets: ['es2015'],
// 						}
// 					},
// 				]
// 			},
// 			entry: {
// 				styleguide: ['babel-polyfill', './styleguide_resources/aigis_resources/scripts/styleguide.js'],
// 			},
// 			output: {
// 				filename: '[name].js',
// 			},
// 		}))
// 		.pipe(gulp.dest('./styleguide_resources/aigis_assets/dist/'))
// 		.pipe(notify("Styleguide Assets Compiled"));
// });
//
// gulp.task('build-styleguide', function() {
// 	return gulp
// 		.src('./styleguide_config.yml')
// 		.pipe(aigis())
// 		.pipe(notify("Styleguide Generated"));
// });
//
// gulp.task('styleguide', function() {
// 	if ( fs.existsSync('./resources/css') ) {
// 		runSequence('compile-styleguide', 'build-styleguide');
// 	} else {
// 		console.log('\x1b[31m%s\x1b[0m', '\n ABORTED: directory "/resources/css" does not exist');
// 		console.log(' Run `yarn run build` to first compile project assets \n');
// 	}
// });

gulp.task('svgstore', function () {

	return gulp
		.src('resources/img/icons/*.svg')
		.pipe(svgmin())
		.pipe(svgstore({ inlineSvg: true }))
		.pipe(gulp.dest('dist/img/'));

});


 //******
// WATCH

gulp.task('default', ['watch']);

gulp.task('watch', function () {
	gulp.watch('resources/img/icons/*.svg', ['svgstore']);
});

gulp.task('post-deploy', ['svgstore']);
