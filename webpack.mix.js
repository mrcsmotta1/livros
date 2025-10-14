const mix = require('laravel-mix');


mix
    .sass('resources/css/app.scss', 'public/css')
    .postCss('resources/css/guest.css', 'public/css', [
        require('tailwindcss'),
    ])
    .js('resources/js/app.js', 'public/js')
    .version();;
