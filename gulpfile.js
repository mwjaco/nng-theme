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
const concat = require('gulp-concat');
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

gulp.task('js', function() {
  return gulp.src('src/js/**/*.js')
    .pipe(sourcemaps.init())
    .pipe(concat('app.js'))
    .on('error', onError)
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('dist/js'))
    .pipe(browserSync.stream());
});

gulp.task('copy', function() {
  return gulp.src('src/**/*.html')
    .pipe(useref())
    .pipe(gulpif('*.js', sourcemaps.init()))
    .pipe(gulpif('*.js', uglify().on('error', function(e){
      console.log(e);
     })))
    .pipe(gulpif('*.js', sourcemaps.write('.')))
    .pipe(gulp.dest('dist'))
    .pipe(browserSync.stream());
});

gulp.task('images', function() {
  gulp.src('src/img/*')
    .pipe(imagemin())
    .pipe(gulp.dest('dist/img'));
});

gulp.task('browserSync', function() {
  browserSync.init({
    browser: 'google chrome',
    server: {
      baseDir: 'dist',
      index: 'locations.html'
    }
  })
});

gulp.task('watch', ['browserSync', 'css'], function() {
  gulp.watch('src/sass/**/*.scss', ['css']);
  gulp.watch('src/**/*.+(html|js)', ['copy']);
});
