import conf from '../config'
import gulp from 'gulp'

gulp.task(
  'build',
  gulp.series(
    'php:prod',
    () => {
      return gulp
        .src(`./${conf.src}/**/*.+(jpg|jpeg|png|gif|svg)`)
        .pipe(gulp.dest(`${process.env.NODE_ENV}/${conf.htdocs}`))
    },
    () => {
      return gulp
        .src(`./${conf.src}/**/*.+(eot|ttf|woff|woff2)`)
        .pipe(gulp.dest(`${process.env.NODE_ENV}/${conf.htdocs}`))
    },
    'js:prod',
    'css:prod'
  )
)

gulp.task('build:dev', gulp.series('php:dev', 'js:dev', 'css:dev', 'watch'))
