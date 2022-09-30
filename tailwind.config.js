module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        container: {
            center: true,
            padding: {
                sm: '2rem !important',
                lg: '2rem !important',
                xl: '0rem !important',
                '2xl': '0rem !important',
            }
        },
        extend: {
            colors: {
                brand: {
                    DEFAULT: '#01847F',
                    dark: '#0F5C5A',
                    900: '#1A908C',
                    800: '#349D99',
                    700: '#4DA9A5',
                    600: '#67B5B2',
                    500: '#80C2BF',
                    400: '#99CECC',
                    300: '#B3DAD9',
                    200: '#CCE6E5',
                    100: '#E6F3F2',
                    50: '#F2F9F9',
                },
                brandSecondary: {
                    DEFAULT: '#700E19',
                    dark: '#500a11',
                    900: '#7E2630',
                    800: '#8D3E47',
                    700: '#9B565E',
                    600: '#A96E75',
                    500: '#B8878C',
                    400: '#C69FA3',
                    300: '#D4B7BA',
                    200: '#E2CFD1',
                    100: '#F1E7E8',
                    50: '#F8F3F4',
                }
            },
        },
    },
    plugins: [
        require('@tailwindcss/line-clamp'),
        require('@tailwindcss/aspect-ratio'),
    ],
}
