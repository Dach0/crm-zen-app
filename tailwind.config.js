const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
        './index.html',
        './src/**/*.{vue,js,ts,jsx,tsx}',
    ],
    theme: {
        extend: {

        },
    },

    plugins: [],
};
