let mix = require('laravel-mix')

mix.extend('nova', new require('laravel-nova-devtool'))

mix
  .setPublicPath('dist')
  .js('resources/js/field.js', 'js')
  .vue({ version: 3 })
  // .sass('resources/sass/field.scss', 'css')
  .css('resources/css/field.css', 'css')
  .nova('bbs-lab/nova-toast-ui-editor-field')
