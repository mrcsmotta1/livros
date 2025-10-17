const mix = require('laravel-mix');


mix
    .sass('resources/css/app.scss', 'public/css')
    .postCss('resources/css/guest.css', 'public/css', [
        require('tailwindcss'),
    ])
    .postCss('resources/css/custom-alerts.css', 'public/css')
    .js('resources/js/app.js', 'public/js')
    .js('resources/js/custom-alerts.js', 'public/js')
    .version();;
