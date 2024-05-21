/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "class",
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        container: {
            center: true,
            padding: "25px",
        },
        extend: {
            screens: {
                "2xl": "1320px",
            },
            fontFamily: {
                inter: "Inter",
            },
            colors: {
                "base-light": "#f9fafb",
                "base-dark": "#0f172a",
                "primary-light": "#ffffff",
                "primary-dark": "#1e293b",
                "secondary-light": "#3730a3",
            },
        },
    },
    plugins: [],
};

