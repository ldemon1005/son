var gulp = require('gulp');
var sass = require('gulp-sass');
var browserSync = require('browser-sync').create();
var useref = require('gulp-useref');
var uglify = require('gulp-uglify');        /* Thực hiện minifying các file js */
var gulpif = require('gulp-if');            /* Dùng để kiểm tra chỉ minify các file *.js */
var cssnano = require('gulp-cssnano');      /* Dùng để minifying các file css */
var imagemin = require('gulp-imagemin');    /* Dùng để minifying các file ảnh */
var cache = require('gulp-cache');          /* cache lại các file ảnh */
var del = require('del');                   /* Xóa các file không cần thiết */
var runSequence = require('run-sequence');                   /* Kết hợp các gulp tasks */

/* Khởi tạo live-reloading */
gulp.task('browserSync', function () {
    browserSync.init({
        server: {
            baseDir: 'app',
        },
    })
});


/* Tạo render file sass sang file css */
gulp.task('sass', function () {
    return gulp.src('app/scss/**/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('app/css/'))
        .pipe(browserSync.reload({
            stream: true
        }))
});

gulp.task('useref', function () {
   return gulp.src('app/*.html')
       .pipe(useref())
       .pipe(gulpif('*.css', cssnano()))
       .pipe(gulpif('*.js', uglify()))
       .pipe(gulp.dest('dist'))
});

/* Theo dõi sự thay đổi của các file sass */
gulp.task('watch', function () {
    gulp.watch('app/scss/**/*.scss', ['sass']);
    gulp.watch('app/*.html*', browserSync.reload);
    gulp.watch('app/js/**/*.js', browserSync.reload);
});

gulp.task('images', function () {
   return gulp.src('app/images/**/*.+(png|jpg|jpeg|gif|svg)')
       .pipe(cache(imagemin({
           interlaced: true
       })))
       .pipe(gulp.dest('dist/images'))
});

gulp.task('fonts', function () {
   return gulp.src('app/fonts/**/*')
       .pipe(gulp.dest('dist/fonts'))
});

gulp.task('clean:dist', function () {
    return del.sync('dist')
});

/* Xóa cache trên hệ thống local */
gulp.task('clean:clear', function () {
    return cache.clearAll(callback())
});

gulp.task('build', function (callback) {
   runSequence('clean:dist', ['sass', 'useref', 'images', 'fonts'], callback)
});

gulp.task('default', function (callback) {
   runSequence(['sass', 'browserSync'], 'watch', callback)
});





