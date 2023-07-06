const mix = require("laravel-mix");

mix.setPublicPath("origamiez/");

// Main style.
mix.sass("style.scss", "origamiez/");

// Bootstrap
mix.sass(
  "node_modules/bootstrap/scss/bootstrap.scss",
  "origamiez/css/bootstrap.css"
);

// Fontawesome
mix.css(
  "node_modules/@fortawesome/fontawesome-free/css/all.css",
  "origamiez/css/fontawesome.css"
);

// Owl Carousel
mix
  .css(
    "node_modules/owl.carousel/dist/assets/owl.carousel.css",
    "origamiez/css/owl.carousel.css"
  )
  .css(
    "node_modules/owl.carousel/dist/assets/owl.theme.default.css",
    "origamiez/css/owl.theme.default.css"
  );

mix.css(
  "node_modules/superfish/dist/css/superfish.css",
  "origamiez/css/superfish.css"
);

mix.cp(
  "node_modules/superfish/dist/css/superfish.css",
  "origamiez/css/superfish.css"
);
