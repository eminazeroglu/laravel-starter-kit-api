module.exports = {
    darkMode: "class",
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

            },
        },
    },
    plugins: [
        require('@tailwindcss/line-clamp'),
        require('@tailwindcss/aspect-ratio'),
    ],
}
