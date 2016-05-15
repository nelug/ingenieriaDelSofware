'use strict';
/*
* Dependencies
*/
var gulp = require('gulp'),
concat = require('gulp-concat'),
minifyCss = require('gulp-minify-css'),
notify = require("gulp-notify"),
livereload = require('gulp-livereload'),
uglify = require('gulp-uglify');

/*
* CSS configuration
*/
gulp.task('cssMain', function () {
	return gulp.src([
        'app/assets/components/bower/bootstrap/dist/css/bootstrap.min.css',
        'app/assets/components/bower/font-awesome/css/font-awesome.min.css',
        'app/assets/components/bower/datatables/media/css/jquery.dataTables.css',
	])
	.pipe(concat('main.css'))
	.pipe(gulp.dest('public/css/'))
});

gulp.task('cssCustom', function () {
	return gulp.src([
        'app/assets/css/**/*.css',
	])
	.pipe(concat('custom.css'))
	.pipe(gulp.dest('public/css/'))
	.pipe(livereload())
});

/*
* JS configuration
*/
gulp.task('jsMain', function () {
	return gulp.src([
		'app/assets/components/bower/jquery/jquery.js',
        'app/assets/components/bower/bootstrap/dist/js/bootstrap.js',
        'app/assets/components/bower/jquery-nicescroll/jquery.nicescroll.js',
        'app/assets/js/jpreloader-v2/js/jpreloader.js',
        'app/assets/components/bower/jquery.easing/js/jquery.easing.js',
        'app/assets/components/bower/datatables/media/js/jquery.dataTables.js',
        'app/assets/components/bower/highcharts/highcharts.js',
        'app/assets/components/bower/highcharts/highcharts-3d.js',
        'app/assets/components/bower/highcharts/modules/exporting.js',
        'app/assets/js/plugins/**/*.js'
	])
	.pipe(concat('main.js'))
	.pipe(gulp.dest('public/js/'))
});

gulp.task('jsCustom', function () {
	return gulp.src([
	    'app/assets/js/*.js',
	])
	.pipe(concat('custom.js'))
	.pipe(gulp.dest('public/js/'))
    .pipe(livereload())
});

/*
* Concat all js files
*/
gulp.task('compress-js', ['cssMain', 'jsMain', 'jsCustom'], function() {
  return gulp.src('public/js/*.js')
    .pipe(uglify())
    .pipe(gulp.dest('public/js/'));
});

/*
* Minify all css files
*/
gulp.task('compress-css', ['cssMain', 'jsMain', 'jsCustom'], function() {
    return gulp.src('public/css/*.css')
    .pipe(minifyCss())
    .pipe(gulp.dest('public/css'));
});

/*
* Keep an eye on css, js, and PHP files for changes...
*/
gulp.task('watch', ['cssMain', 'cssCustom', 'jsMain'], function() {
    livereload.listen();
	gulp.watch('app/assets/js/*.js', ['jsCustom']);
	gulp.watch('app/assets/cliente/js/*.js', ['jsCliente']);
	gulp.watch('app/assets/proveedor/js/*.js', ['jsProveedor']);
    gulp.watch('app/assets/css/**/*.css', ['cssCustom']);
    gulp.watch('app/assets/proveedor/css/*.css', ['cssProveedor']);
    gulp.watch('app/assets/cliente/css/*.css', ['cssCliente']);
});

// .pipe(notify({ message: 'All done'}))
/*
* Fonts.
*/
gulp.task('fonts', function() {
    return gulp.src([
        'app/assets/components/bower/bootstrap/dist/fonts/glyphicons-halflings-regular.*',
        'app/assets/components/bower/font-awesome/fonts/fontawesome-webfont.*'
    ])
    .pipe(gulp.dest('public/fonts/'));
});

/*
* Default task will run only when you type the command gulp.
*/
gulp.task('default', ['cssMain', 'cssCustom', 'jsMain', 'jsCustom', 'watch']);

/*
* Task to run on production server.
*/
gulp.task('build', ['cssMain', 'cssCustom', 'jsMain', 'jsCustom', 'compress-js', 'compress-css', 'fonts']);

/*
* Task to run on production server without minify.
*/
gulp.task('update', ['cssMain', 'cssCustom', 'jsMain', 'jsCustom']);
