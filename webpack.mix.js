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
    .sass('resources/sass/app.scss', 'public/css');

// https://stackoverflow.com/questions/58659571/separate-js-file-for-bundle-and-components-in-vuejs

let fs = require('fs');

let getFiles = function (dir) {
  // get all 'files' in this directory
  // filter directories
  return fs.readdirSync(dir).filter(file => {
    return fs.statSync(`${dir}/${file}`).isFile();
  });
};

getFiles('resources/js/modules').forEach(function (filepath) {
  mix.js('resources/js/modules/' + filepath, 'js/modules');
});
