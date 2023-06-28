const mix = require('laravel-mix');

const dist = {
    js: 'origamiez/js',
    css: 'origamiez/css'
}

// mix.copy('node_modules/superfish/dist/js/superfish.js', `${dist.js}/superfish.js`)
//     .copy('node_modules/slick-carousel/slick/slick.js', `${dist.js}/slick.js`)
//     .copy('assets/js/static/jquery.pin-box.js', `${dist.js}/jquery.pin-box.js`)

// mix.js('assets/js/admin.theme.js', dist.js)
//     .js('assets/js/ie.theme.js', dist.js)
//     .js('assets/js/theme.js', dist.js);

// mix.sass('assets/sass/bundle.sass', dist.css).options({processCssUrls: false})

mix.sass('style.sass', 'origamiez/');