const { src, dest, parallel } = require('gulp');
const sass = require('gulp-sass');
const minifyCSS = require('gulp-csso');
const comment = require('gulp-header-comment');

function css() {
    return src('./style.scss')
        .pipe(sass())
        .pipe(minifyCSS())
        .pipe(comment({
            file: './theme.info',
            encoding: 'utf-8'
        }))
        .pipe(dest('./'))
}
exports.css = css;
exports.default = parallel(css);