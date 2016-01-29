var gulp = require('gulp'),

	// general
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
	jshint = require('gulp-jshint'),
	uglify = require('gulp-uglify'),

	// pattern library
	patternLibrary = require("gulp-theideabureau-pattern-library");


 //**************
// ERROR HANDLER

function onError(err) {
	console.log(err);
	notify().write(err)
	this.emit('end');
};


 //******
// TASKS

gulp.task('templates', function() {

	gulp.src(['patterns/templates/**/*.html', 'patterns/templates/**/*.json'])
		.pipe(patternLibrary({
			filename: 'paths.json'
		}))
		.pipe(gulp.dest('patterns'));

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

gulp.task('scss-lint', function() {
	gulp.src('assets/scss/**/*.scss')
		.pipe(scsslint({'config': 'lint.yml'}));
});

gulp.task('js', function () {

	return gulp.src('assets/js/main.js')
		.pipe(plumber({ errorHandler: onError }))
		.pipe(jshint())
		.pipe(jshint.reporter('jshint-stylish'))
		.pipe(uglify())
		.pipe(rename({
			extname: '.min.js'
		}))
		.pipe(gulp.dest('assets/js/'))
		.pipe(livereload());

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


 //*********************
// PATTERN LIBRARY APP

gulp.task('pattern-styles', function () {

	return gulp.src('patterns/app/scss/**/*.scss')
		.pipe(plumber({ errorHandler: onError }))
		.pipe(globbing({ extensions: ['.scss'] }))
		.pipe(sass())
		.pipe(autoprefixer('last 2 versions'))
		.pipe(gulp.dest('patterns/build/css'))
		.pipe(concat('styles.min.css'))
		.pipe(minifyCss({compatibility: 'ie8'}))
		.pipe(livereload())
		.pipe(notify("Pattern Styles Compiled"));

});

gulp.task('pattern-scripts', function () {

	return gulp.src('patterns/app/js/main.js')
		.pipe(plumber({ errorHandler: onError }))
		.pipe(jshint())
		.pipe(jshint.reporter('jshint-stylish'))
		.pipe(uglify())
		.pipe(rename({
			extname: '.min.js'
		}))
		.pipe(gulp.dest('patterns/build/js'))
		.pipe(livereload())
		.pipe(notify("Pattern Scripts Compiled"));

});


 //******
// WATCH

gulp.task('default', ['watch']);

gulp.task('watch', function () {

	livereload.listen();

	// boilerplate
	gulp.watch(['patterns/templates/**/*.html', 'patterns/templates/**/*.json'], ['templates']);
	gulp.watch('assets/scss/**/*.scss', ['scss', 'scss-lint', 'modernizr']);
	gulp.watch('assets/js/*.js', ['js', 'modernizr']);

	// pattern library (app only)
	gulp.watch('patterns/app/scss/**/*.scss', ['pattern-styles']);
	gulp.watch('patterns/app/js/*.js', ['pattern-scripts']);

});
