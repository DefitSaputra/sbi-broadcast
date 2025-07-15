import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            // MENAMBAHKAN WARNA BRAND SBI
            colors: {
                'sbi-green': '#c4d600',
                'sbi-red': '#e41e26',
                'sbi-dark-gray': '#212529',
            },
            // MENGGANTI FONT UTAMA MENJADI POPPINS
            fontFamily: {
                sans: ['Poppins', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};