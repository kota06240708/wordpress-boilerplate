import conf from '../config'
import gulp from 'gulp'

gulp.task(
  'build',
  gulp.series(
    'php:dev',
    () => {
      return gulp
        .src(`./${conf.src}/**/*.+(jpg|jpeg|png|gif|svg)`)
        .pipe(gulp.dest(process.env.NODE_ENV))
    },
    () => {
      return gulp
        .src(`./${conf.src}/**/*.+(eot|ttf|woff|woff2)`)
        .pipe(gulp.dest(`${process.env.NODE_ENV}`))
    },
    'js:prod',
    'css:prod'
  )
)

gulp.task('build:dev', gulp.series('php:dev', 'css:dev', 'watch'))
