var gulp = require('gulp');
var sass = require('gulp-ruby-sass');
var prefix = require('gulp-autoprefixer');
var uglify = require('gulp-uglify');
var rename = require("gulp-rename");

gulp.task('sass', function() {
  sass('./library/scss/style.scss', {sourcemap: true, style: 'compact'})
    .pipe(prefix("last 1 version", "> 1%"))
    .pipe(gulp.dest('./library/css'));
});

gulp.task('sass-min', function() {
  sass('./library/scss/style.scss', {sourcemap: true, style: 'compressed'})
    .pipe(prefix("last 1 version", "> 1%"))
    .pipe(rename('style.min.css'))
    .pipe(gulp.dest('./library/css'));
});

gulp.task('compressJS', function() {
  return gulp.src('./library/js/scripts.js')
    .pipe(uglify({preserveComments: 'some'}))
    .pipe(rename('scripts.min.js'))
    .pipe(gulp.dest('./library/js'));
});

gulp.task('default', ['sass','sass-min','compressJS']);

gulp.task('sass:watch', function () {
  gulp.watch('./sass/**/*.scss', ['sass','sass-min']);
});
