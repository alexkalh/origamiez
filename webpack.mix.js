const mix = require("laravel-mix");
require('laravel-mix-string-replace');

mix
  .setPublicPath("origamiez/")
  .sass("style.scss", "origamiez/")
  .stringReplace({
    test: /style\.scss$/,
    loader: "string-replace-loader",
    options: {
      search: "STYLE_VERSION",
      replace: `2.0.${Math.floor(Date.now() / 1000)}`,
    },
  });

mix
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
    "node_modules/jquery.poptrox/jquery.poptrox.js",
    "origamiez/js/jquery.poptrox.js"
  )
  .copy(
    "node_modules/slidebars/dist/slidebars.css",
    "origamiez/css/slidebars.css"
  )
  .copy(
    "node_modules/slidebars/dist/slidebars.js",
    "origamiez/js/slidebars.js"
  );
