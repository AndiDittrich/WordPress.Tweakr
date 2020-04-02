// GULP plugins
var gulp = require('gulp');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var less = require('gulp-less');
var cleanCSS = require('gulp-clean-css');
var prettyError = require('gulp-prettyerror');
var autoprefixer = require('gulp-autoprefixer');


// Minify JS
gulp.task('js', function () {
    return gulp.src(['resources/**/*.js', '!resources/**/*.min.js'])
        .pipe(prettyError())
        .pipe(uglify())
        .pipe(rename({ suffix: '.min' }))
        .pipe(gulp.dest('resources/'));
});

// Resources LESS to CSS
gulp.task('less', function () {
    return gulp.src(['resources/**/*.less'])
        .pipe(prettyError())
        .pipe(less())
        .pipe(autoprefixer({
            browsers: ['last 2 versions'],
            cascade: false
        }))
        .pipe(cleanCSS({
            compatibility: 'ie8',
            advanced: false
        }))
        .pipe(rename({ suffix: '.min' }))
        .pipe(gulp.dest('resources/'));
});

gulp.task('default', gulp.series(['less', 'js']));