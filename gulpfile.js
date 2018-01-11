const gulp = require('gulp');
const autoprefixer = require('gulp-autoprefixer');
const babel = require('gulp-babel');
const gulpif = require('gulp-if');
const imagemin = require('gulp-imagemin');
const sass = require('gulp-sass');
const sourcemaps = require('gulp-sourcemaps');
const uglify = require('gulp-uglify');
const uncss = require('gulp-uncss');
const useref = require('gulp-useref');
const browserSync = require('browser-sync').create();

const onError = function(err) {
  console.log(err.message);
  this.emit('end');
};

gulp.task('css', function() {
  return gulp.src('src/sass/**/*.scss')
    .pipe(sourcemaps.init())
    .pipe(sass({outputStyle: 'compressed'}).on('error', onError))
    .pipe(autoprefixer({
      browsers: ['last 2 versions']
    }))
    .pipe(sourcemaps.write('./maps'))
    .pipe(gulp.dest('dist/css'))
    .pipe(browserSync.stream());
});

gulp.task('copy', function() {
  return gulp.src('src/**/*.html')
    .pipe(useref())
    .pipe(gulpif('*.js', sourcemaps.init()))
    .pipe(gulpif('*.js', uglify()))
    .pipe(gulpif('*.js', sourcemaps.write('.')))
    .pipe(gulp.dest('dist'))
    .pipe(browserSync.stream());
});

gulp.task('browserSync', function() {
  browserSync.init({
    browser: 'google chrome',
    server: {
      baseDir: 'dist'
    }
  })
});

gulp.task('watch', ['browserSync', 'css'], function() {
  gulp.watch('src/sass/**/*.scss', ['css']);
  gulp.watch('src/**/*.+(html|js)', ['copy']);
});
