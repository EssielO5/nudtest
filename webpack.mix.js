// webpack.mix.js
const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .postCss('resources/css/app.css', 'public/css', [
       //
   ])
   .vite({
       build: {
           manifest: true,
           outDir: 'public/build'
       }
   });
