const mix = require("laravel-mix");
const VuetifyLoaderPlugin = require("vuetify-loader/lib/plugin");
var CaseSensitivePathsPlugin = require("case-sensitive-paths-webpack-plugin");

mix.extend(
    "vuetify",
    new (class {
        webpackConfig(config) {
            config.plugins.push(new VuetifyLoaderPlugin());
            config.plugins.push(new CaseSensitivePathsPlugin());
        }
    })()
);
mix.vuetify();
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js("resources/js/vue.js", "public/js")
    .vue()
    .js("resources/js/app.js", "public/js")
    // .sass("resources/sass/app.sass", "public/css")
    .postCss("resources/css/app.css", "public/css", [
        require("tailwindcss"),
        require("autoprefixer"),
    ])
    .options({
        processCssUrls: false,
    });
