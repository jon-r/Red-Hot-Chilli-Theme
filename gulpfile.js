var gulp = require('gulp');
var sass = require('gulp-ruby-sass');
var prefix = require('gulp-autoprefixer');
var uglify = require('gulp-uglify');
var rename = require("gulp-rename");
var zip = require('gulp-zip');

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

gulp.task('minjs', function() {
  return gulp.src('./library/js/scripts.js')
    .pipe(uglify({preserveComments: 'some'}))
    .pipe(rename('scripts.min.js'))
    .pipe(gulp.dest('./library/js'));
});

gulp.task('default', ['sass','sass-min','minjs']);

gulp.task('sasswatch', function () {
  gulp.watch('./library/scss/**/*.scss', ['sass','sass-min']);
});
gulp.task('jswatch', function () {
  gulp.watch('./library/js/scripts.js', ['minjs']);
});

gulp.task('watch', function () {
  gulp.watch('./library/scss/**/*.scss', ['sass','sass-min']);
  gulp.watch('./library/js/scripts.js', ['minjs']);
});

gulp.task('zip', function() {
  return gulp.src(['../Red*/**', '!./node_modules/**'])
      .pipe(zip('Red-Hot-Chilli-Theme-home.zip'))
      .pipe(gulp.dest('../'));
})
