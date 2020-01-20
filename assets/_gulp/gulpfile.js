// Include gulp
var gulp = require('gulp');
var browserSync = require('browser-sync').create();

// Include Plugins
var jshint = require('gulp-jshint');
var sass = require('gulp-sass');
var sassGlob = require('gulp-sass-glob');
var sourcemaps = require('gulp-sourcemaps');
var concat = require('gulp-concat');
var concatCss = require('gulp-concat-css');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var cssmin = require('gulp-cssmin');
var debug  = require('gulp-debug');

// Lint Task
gulp.task('lint', function () {
    return gulp.src([
        '../js/modules.js',
    ])
        .pipe(jshint())
        .pipe(jshint.reporter('default'));
});

// Concatenate
gulp.task('all', function () {
    return gulp.src([
        '../_js/modules/global/main.js',
        '../_js/modules/global/common.js',
        '../_js/modules/charts/charts.js',
    ]).pipe(concat('modules.js'))
        .pipe(gulp.dest('../js'));
});

gulp.task('third_party', function () {
    return gulp.src([
        '../_js/third-party/test.js'
    ]).pipe(concat('third-party.js'))
        .pipe(gulp.dest('../js'));
});

// Minify JS
gulp.task('minifyjs', gulp.series('all', 'third_party', function () {
    return gulp.src([
        '../js/modules.js',
        //'../js/third-party.js'
        // '../js/profile.js',
        // '../js/create-task.js',
    ]).pipe(uglify().on('error', function(e){
        console.log(e);
    }))
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('../js'))
}));

// Compile Our Sass
gulp.task('sass', function () {
    return gulp.src('../_scss/*.scss')
        .pipe(sourcemaps.init({loadMaps: true}))
        .pipe(sassGlob())
        .pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
        .pipe(sourcemaps.write('../css'))
        .pipe(gulp.dest('../css'))
});

gulp.task('minifycss', gulp.series('sass', function () {
    return gulp.src([
        '../css/main.css',
        '../css/main-responsive.css',
    ])
        .pipe(cssmin())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('../css'))
        .pipe(browserSync.stream())
}));

// Default Task
gulp.task('default', gulp.series('all', 'third_party', 'sass'));

// Minify Files
gulp.task('minify', gulp.series('minifyjs', 'minifycss'));

// Watch Files For Changes
gulp.task('watch', function () {
    gulp.watch('../_js/modules/**/*.js', gulp.series('all', 'third_party'));
    gulp.watch('../_scss/**/*.scss', gulp.series('sass'));
});

gulp.task('dev', function () {
	browserSync.init({
		proxy: "datastud.lcl"
	});

    gulp.watch('../_js/modules/**/*.js', gulp.series('all', 'third_party'));
    gulp.watch('../_scss/**/*.scss', gulp.series('sass'));
});