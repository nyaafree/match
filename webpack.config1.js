const path = require('path');
import VueLoaderPlugin from 'vue-loader/lib/plugin';

module.exports = {
    mode: 'development',
  entry: path.join(__dirname, 'resources/js/app.js'),
  output: {
    path: path.join(__dirname, 'public/dist/js'),
    filename: 'bundle.js'
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
            loader: 'babel-loader',
            options: {
              presets: ['@babel/preset-env']
            }
          }
      },
      {
        test: /\.vue$/,
         loader: 'vue-loader',
         options: {
             options: {
                  presets: [
                      'es2015',
                           {
                           targets: {
                               browsers: ['last 2 versions', 'safari 7', 'edge 14'],
                           },
                      },
                  ],
              },
          },
      },
    ],
  },
  resolve: {
    modules: [path.join(__dirname, 'resources/js'), 'node_modules'],
    extensions: ['.js','.vue','.json'],
    alias: {
      vue$: 'vue/dist/vue.esm.js'
    }
  },
  plugins: [
    new VueLoaderPlugin(),
],
};
