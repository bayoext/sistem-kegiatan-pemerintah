import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
          "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],

     theme: {
        extend: {
            colors: {
                // 60% Primary Color (Dominant)
                primary: {
                    50: '#eff6ff',
                    100: '#dbeafe',
                    500: '#3b82f6', // Main primary (60%)
                    600: '#2563eb',
                    700: '#1d4ed8',
                },
                // 30% Secondary Color
                secondary: {
                    500: '#10b981', // Secondary (30%)
                    600: '#059669',
                },
                // 10% Accent Color
                accent: {
                    500: '#f59e0b', // Accent (10%)
                    600: '#d97706',
                },
            },
            fontFamily: {
                sans: ['Inter', 'system-ui', 'sans-serif'],
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
    ],
};
