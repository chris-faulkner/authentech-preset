let mix = require("laravel-mix");

require("laravel-mix-tailwind");
require("laravel-mix-purgecss");

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

mix.js("resources/assets/js/app.js", "public/js")
    .sass("resources/assets/sass/app.scss", "public/css")
    .tailwind();


if (mix.inProduction()) {
    mix.purgeCss({
        enabled: true,

        // Your custom globs are merged with the default globs. If you need to fully replace
        // the globs, use the underlying `paths` option instead.
        globs: [
            path.join(__dirname, 'node_modules/simplemde/**/*.js'),
        ],

        extensions: ['html', 'js', 'php', 'vue'],

        // Other options are passed through to Purgecss
        whitelistPatterns: [/language/, /hljs/, /alert/],
    });

    mix.version();
}

mix.browserSync({
    open: 'external',
    host: 'to-do.test',
    proxy: 'to-do.test',
    port: 3000
});