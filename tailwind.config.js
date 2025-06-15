import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                // sans: ["Figtree", ...defaultTheme.fontFamily.sans],
                sans: ["Poppins", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'primary': {
                    DEFAULT: '#00A389', // Fresh Teal
                    'dark': '#008C73',
                    'light': '#66D4C2',
                },
                'secondary': {
                    DEFAULT: '#FF7D45', // Warm Orange
                    'dark': '#E86A34',
                    'light': '#FFAA85',
                },
                'accent': {
                    DEFAULT: '#FFD166', // Soft Yellow
                    'dark': '#E8B94A',
                    'light': '#FFDF94',
                },
                'gray': {
                    'dark': '#3D4852',
                    'light': '#F8FAFC',
                },
            }
        },
    },

    plugins: [forms],
};
