import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

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
                serif: ['Merriweather', ...defaultTheme.fontFamily.serif],
                display: ['Playfair Display', ...defaultTheme.fontFamily.serif],
            },
            colors: {
                // Историческая палитра
                parchment: {
                    50: '#FEFCF8',
                    100: '#FAF8F3',
                    200: '#F5F1E8',
                    300: '#EDE6D3',
                    400: '#E0D4B8',
                    500: '#D3C6B3',
                    600: '#B8A896',
                    700: '#9D8B79',
                    800: '#7A6B5C',
                    900: '#5C4F42',
                },
                ink: {
                    50: '#F7F6F5',
                    100: '#E8E6E3',
                    200: '#D1CDC7',
                    300: '#B0A9A0',
                    400: '#8B827A',
                    500: '#443C36',
                    600: '#3A332E',
                    700: '#2F2A26',
                    800: '#25211E',
                    900: '#1C1916',
                },
                gold: {
                    50: '#FDF8F0',
                    100: '#F9EDDB',
                    200: '#F2D9B3',
                    300: '#E8C085',
                    400: '#DBA55C',
                    500: '#B59164',
                    600: '#A17E56',
                    700: '#8B6B48',
                    800: '#75583A',
                    900: '#5F462D',
                },
                burgundy: {
                    50: '#FDF2F2',
                    100: '#FCE8E8',
                    200: '#F8D1D1',
                    300: '#F2ABAB',
                    400: '#E97575',
                    500: '#722F37',
                    600: '#652A31',
                    700: '#58242A',
                    800: '#4B1F23',
                    900: '#3E1A1D',
                },
            },
        },
    },

    plugins: [forms, typography],
};
