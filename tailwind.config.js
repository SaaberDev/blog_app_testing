const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    mode: 'jit',
    important: true,
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        colors: {
            white: '#ffffff',
            ink: '#3b2f28',
            paper: '#fbfaf7',
            link: '#ff7f00',
        },
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                display: ['"Playfair Display"'],
            },
        },
    },
    plugins: [require('@tailwindcss/forms')],
};
