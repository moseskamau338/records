import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import { colors } from "./resources/js/theme/colors";

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "class",
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
    ],

    theme: {
        extend: {
            colors: {
                ...colors,
                brand: {
                    DEFAULT: colors.indigo["900"],
                },
            },
        },
    },

    plugins: [
        require("@savaryna/tailwindcss-material-symbols"),
        require("@tailwindcss/typography"),
        forms,
    ],
};
