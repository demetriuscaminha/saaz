var gulp = require('gulp');
var sass = require('gulp-sass');
var rename = require('gulp-rename');
var sourcemaps = require('gulp-sourcemaps');
var postcss = require('gulp-postcss');
var autoprefixer = require('autoprefixer');
var cssnano = require('cssnano');

var PATH = {
	css: 'css/',
	scss: 'scss/'
};

gulp.task('sass', function(){
    return gulp.src(PATH.scss + 'style.scss')
    .pipe(sourcemaps.init())
    .pipe(sass().on('error', sass.logError))
    .pipe(sourcemaps.write('../maps'))
    .pipe(gulp.dest(PATH.css))
 });

gulp.task('styles', function(){
    var processors = [
        autoprefixer(),
        cssnano(),
     ];
     return gulp.src(PATH.css + 'style.css')
        .pipe(postcss(processors))
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest(PATH.css))
});

gulp.task('watch', function(){
 
    gulp.watch(PATH.scss + '*.scss', gulp.series(['sass', 'styles']));
    gulp.watch(PATH.css + '*.css')
 });
 
 gulp.task('default', gulp.series(['styles', 'watch']));