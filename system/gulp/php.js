import conf from '../config'

import gulp from 'gulp'
import rename from 'gulp-rename'
import plumber from 'gulp-plumber'
import notify from 'gulp-notify'

console.log(process.env.NODE_ENV)

const build = () => {
  return gulp
    .src(`./${conf.src}/**/${conf.php}`)
    .pipe(
      plumber({
        errorHandler: notify.onError('Error: <%= error.message %>')
      })
    )
    .pipe(
      rename(path => {
        path.dirname += '/../' // 単純に今のパスに parentを追加しているだけ
      })
    )
    .pipe(
      gulp.dest(
        process.env.NODE_ENV
          ? `./${process.env.NODE_ENV}/${conf.htdocs}`
          : `./${conf.dist}/${conf.htdocs}`
      )
    )
}

gulp.task('php:dev', gulp.parallel(() => build()))
gulp.task('php:prod', gulp.parallel(() => build()))
