import conf from '../config'

import gulp from 'gulp'
import plumber from 'gulp-plumber'
import notify from 'gulp-notify'

gulp.task(
  'php:dev',
  gulp.parallel(() => {
    return gulp
      .src(`./${conf.src}/**/${conf.php}`)
      .pipe(
        plumber({
          errorHandler: notify.onError('Error: <%= error.message %>')
        })
      )
      .pipe(gulp.dest(`./${conf.dist}`))
  })
)
