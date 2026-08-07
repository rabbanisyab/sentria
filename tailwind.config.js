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
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                display: ['"Space Grotesk"', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                canvas: '#F4F2FB',
                ink: {
                    DEFAULT: '#1C1533',
                    muted: '#6B6480',
                    soft: '#9A93AE',
                },
                brand: {
                    50: '#F1EEFB',
                    100: '#E4DEF7',
                    200: '#C9BEF0',
                    300: '#A793E6',
                    400: '#8B72DE',
                    500: '#6C56E5',
                    600: '#5B42DB',
                    700: '#4630B5',
                    800: '#352481',
                    900: '#1E1547',
                    950: '#130D33',
                },
            },
            boxShadow: {
                card: '0 1px 2px rgba(28, 21, 51, 0.04), 0 8px 24px -12px rgba(28, 21, 51, 0.12)',
                glow: '0 0 0 1px rgba(255,255,255,0.06), 0 12px 32px -8px rgba(91, 66, 219, 0.55)',
            },
        },
    },

    plugins: [forms],
};
