const mix = require('laravel-mix');

mix.sass('style.scss', 'origamiez/');

mix.sass('node_modules/bootstrap/scss/bootstrap.scss', 'origamiez/css/bootstrap.css')