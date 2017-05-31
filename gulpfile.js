'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');

gulp.task('sass', function () {
  return gulp.src('./resources/assets/sass/**/main.scss')
    .pipe(sass({outputStyle: 'compressed'}))
    .pipe(gulp.dest('./public/css/'));
});

gulp.task('sass:watch', function () {
  gulp.watch('./resources/assets/sass/**/*.scss', ['sass']);
});


gulp.task('sassd', function () {
  return gulp.src('./resources/assets/dashboard/dashboard.scss')
    .pipe(sass({outputStyle: 'compressed'}))
    .pipe(gulp.dest('./public/css/'));
});

gulp.task('sass:watch', function () {
  gulp.watch('./resources/assets/dashboard/**/*.scss', ['sass']);
});