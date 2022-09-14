/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ['./resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.bootstrap',
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    ],
    theme: {
        extend: {},
    },
    plugins: [],
}
