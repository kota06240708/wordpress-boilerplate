import conf from '../config'
import gulp from 'gulp'

gulp.task(
  'watch',
  gulp.parallel(done => {
    gulp.watch(
      `./${conf.src}/**/${conf.php}`,
      gulp.parallel('php:dev', 'reload')
    )
    gulp.watch(
      `./${conf.src}/**/${conf.css}`,
      gulp.parallel('css:dev', 'reload')
    )
    gulp.watch(`./${conf.src}/**/${conf.js}`, gulp.task('reload'))
    done()
  })
)
