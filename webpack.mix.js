const mix = require('laravel-mix');

mix.js('resources/assets/js/script.js', 'public/assets/js')
    .postCss("resources/assets/css/style.css", "public/assets/css", [
        require("tailwindcss"),
    ]);

if (mix.inProduction()) {
    mix.version();
}

mix.disableNotifications();
