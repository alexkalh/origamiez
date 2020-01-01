const { src, dest, parallel, watch } = require('gulp');
const sass = require('gulp-sass');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');
const sourcemaps = require('gulp-sourcemaps');
const browserSync = require('browser-sync').create();

const paths = {
    styles: {
        src: './style.scss',
        dest: '.'
    }
};

const style = () => {
    return src(paths.styles.src)
        // Initialize sourcemaps before compilation starts
        .pipe(sourcemaps.init())
        .pipe(sass())
        .on('error', sass.logError)
        // Use postcss with autoprefixer and compress the compiled file using cssnano
        // .pipe(postcss([autoprefixer(), cssnano()]))
        .pipe(postcss([autoprefixer()]))
        // Now add/write the sourcemaps
        .pipe(sourcemaps.write(paths.styles.dest))
        .pipe(dest(paths.styles.dest))
        .pipe(browserSync.stream());
};

const live = () => {
    browserSync.init({
        proxy: 'origamiez.local'
    });
    watch(paths.styles.src, style);
};


const reload = () => browserSync.reload();

exports.live = live;
exports.style = style;
exports.default = parallel(live);