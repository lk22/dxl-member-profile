'use strict';
var gulp = require('gulp');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
sass.compiler = require('sass');
gulp.task('sass', function () {
   return gulp.src('./assets/sass/app.scss')
   .pipe(sass().on('error', sass.logError))
   .pipe(gulp.dest('./dist/'));
});