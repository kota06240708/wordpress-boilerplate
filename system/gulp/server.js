import conf from '../config'
import gulp from 'gulp'

gulp.task(
  'watch',
  gulp.parallel(done => {
    gulp.watch(`./${conf.src}/**/${conf.php}`, gulp.task('php:dev'))
    gulp.watch(`./${conf.src}/**/${conf.css}`, gulp.task('css:dev'))
    gulp.watch(`./${conf.src}/**/${conf.js}`, gulp.task('js:dev'))
    done()
  })
)
