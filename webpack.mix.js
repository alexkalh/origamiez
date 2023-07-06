const mix = require('laravel-mix');

mix.setPublicPath('origamiez/');

// Main style.
mix.sass('style.scss', 'origamiez/');

// Bootstrap
mix.sass('node_modules/bootstrap/scss/bootstrap.scss', 'origamiez/css/bootstrap.css')

// Fontawesome
mix.css('node_modules/@fortawesome/fontawesome-free/css/all.css', 'origamiez/css/fontawesome.css')