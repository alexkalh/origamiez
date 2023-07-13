const mix = require("laravel-mix");
require('laravel-mix-string-replace');

mix
    .setPublicPath("origamiez/")
    .stringReplace(
        [
            {
                test: /style\.scss$/,
                loader: "string-replace-loader",
                options: {
                    search: "STYLE_VERSION",
                    replace: `2.0.${Math.floor(Date.now() / 1000)}`,
                },
            },
            {
                test: /owl.carousel\.css$/,
                loader: "string-replace-loader",
                options: {
                    search: "owl.video.play.png",
                    replace: "./images/owl-carousel/owl.video.play.png"
                },
            }
        ]
    ).options({
    processCssUrls: false
});

mix
    .sass("style.scss", "origamiez/")
    .sass("assets/sass/typography/default.scss", "origamiez/typography/")
    .sass("assets/sass/skin/default.scss", "origamiez/skin/")
    .sass("assets/sass/skin/custom.scss", "origamiez/skin/")
    .sass(
        "node_modules/bootstrap/scss/bootstrap.scss",
        "origamiez/css/bootstrap.css"
    )
    .css(
        "node_modules/@fortawesome/fontawesome-free/css/all.css",
        "origamiez/css/fontawesome.css"
    )
    .css(
        "node_modules/owl.carousel/dist/assets/owl.carousel.css",
        "origamiez/css/owl.carousel.css"
    )
    .css(
        "node_modules/owl.carousel/dist/assets/owl.theme.default.css",
        "origamiez/css/owl.theme.default.css"
    )
    .copy(
        "node_modules/owl.carousel/dist/owl.carousel.js",
        "origamiez/js/owl.carousel.js"
    )
    .css(
        "node_modules/superfish/dist/css/superfish.css",
        "origamiez/css/superfish.css"
    )
    .copy(
        "node_modules/superfish/dist/js/superfish.js",
        "origamiez/js/superfish.js"
    )
    .copy(
        "node_modules/Navgoco/src/jquery.navgoco.css",
        "origamiez/css/jquery.navgoco.css"
    )
    .copy(
        "node_modules/Navgoco/src/jquery.navgoco.js",
        "origamiez/js/jquery.navgoco.js"
    )
    .copy(
        "node_modules/jquery-poptrox/src/js/jquery.poptrox.js",
        "origamiez/js/jquery.poptrox.js"
    )
    .copy(
        "node_modules/jquery-poptrox/src/css/jquery.poptrox.css",
        "origamiez/css/jquery.poptrox.css"
    )
    .copy(
        "node_modules/jquery-slidebars/src/jquery.slidebars.css",
        "origamiez/css/jquery.slidebars.css"
    )
    .copy(
        "node_modules/jquery-slidebars/src/jquery.slidebars.js",
        "origamiez/js/jquery.slidebars.js"
    );
