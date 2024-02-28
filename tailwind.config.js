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
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
        },
    },
    daisyui: {
        themes: [
            {
                mytheme: {
                    primary: "#4681f4",

                    secondary: "#0000ff",

                    accent: "#d40000",

                    neutral: "#060402",

                    "base-100": "#fff9ff",

                    info: "#00c2e8",

                    success: "#78ca00",

                    warning: "#c34200",

                    error: "#ff5a77",
                },
            },
        ],
    },

    plugins: [forms, require("daisyui")],
};
