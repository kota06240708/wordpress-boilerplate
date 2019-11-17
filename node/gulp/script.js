import gulp from 'gulp'
import util from 'gulp-util'
import webpack from 'webpack'
import webpackConfig from '../webpack/webpack.config.prod.babel'
import webpackConfigDev from '../webpack/webpack.config.dev.babel'

gulp.task('js:dev', done => {
  const webpackSetting = webpack(webpackConfigDev)
  webpackSetting.run((err, stats) => {
    if (err) {
      throw new Error('webpack build failed')
    }
    util.log(
      stats.toString({
        colors: true,
        version: false,
        hash: false,
        timings: false,
        chunks: true,
        chunkModules: false
      })
    )
  })
  done()
})

gulp.task('js:prod', done => {
  const webpackSetting = webpack(webpackConfig)
  webpackSetting.run((err, stats) => {
    if (err) {
      throw new Error('webpack build failed')
    }
    util.log(
      stats.toString({
        colors: true,
        version: false,
        hash: false,
        timings: false,
        chunks: true,
        chunkModules: false
      })
    )
  })
  done()
})
