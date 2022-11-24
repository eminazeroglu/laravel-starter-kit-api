module.exports = {
    darkMode: "class",
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js"
    ],
    theme: {
        container: {
            center: true,
            screens: {
                sm: '640px',
                md: '768px',
                lg: '1024px',
                xl: '1200px',
                '2xl': '1200px',
            },
            padding: {
                sm: '2rem !important',
                lg: '2rem !important',
                xl: '0rem !important',
                '2xl': '0rem !important',
            }
        },
        extend: {
            colors: {
                primary: '#ff3e46',
                secondary: '#64707c'
            },
        },
    },
    plugins: [
        require('@tailwindcss/line-clamp'),
        require('@tailwindcss/aspect-ratio'),
        require('@tailwindcss/typography'),
        require('flowbite/plugin')
    ],
}
