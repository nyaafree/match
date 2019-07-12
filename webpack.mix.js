const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/custom.js','public/js')
    .sass('resources/sass/style.scss', 'public/css/style.css')
    .sourceMaps(false)                                 // 4. SourceMap
    .browserSync({                                     // 6. Browsersync
      open: false,

    });

    // mix.webpackConfig({
    //     plugins: [
    //        new BrowserSyncPlugin(
    //           {
    //              host: '192.168.33.10',
    //              port: 3000,
    //              proxy: 'http://192.168.33.10',
    //              files: [
    //                 './**/*.css',
    //                 './app/**/*',
    //                 './resources/views/**/*',
    //                 './resources/js/**/*.js',
    //              ],
    //              watchOptions: {
    //                usePolling: true,
    //                interval: 500
    //              },
    //              open: true
    //           },
    //           {
    //              reload: true
    //           }
    //        )
    //     ]
    //  })
