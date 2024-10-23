import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            colors:{
                // https://m2.material.io/design/color/dark-theme.html#properties
                dark:{
                    50:'#383838',
                    100:'#353535',
                    200:'#333333',
                    300:'#2D2D2D',
                    400:'#2C2C2C',
                    500:'#272727',
                    600:'#252525',
                    700:'#222222',
                    800:'1E1E1E',
                    900:'#121212',
                }
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
