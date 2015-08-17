var gulp = require('gulp');
var sass = require('gulp-sass');
var connect = require('gulp-connect');
var notify = require("gulp-notify");

gulp.task ('sass', function() {
  return gulp.src ('./sass/**/*.scss')
  .pipe(sass( {errLogToConsole: true } ))
  .pipe (gulp.dest('./css'))
  .pipe(notify({ message: 'Stylesheet written - <%= file.relative %>' }));
});

gulp.task('watch', function() {
  gulp.watch('./sass/**/*.scss', ['sass']);
});

gulp.task('default', ['watch', 'sass']);
