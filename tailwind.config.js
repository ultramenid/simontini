/** @type {import('tailwindcss').Config} */
const defaultTheme = require('tailwindcss/defaultTheme')

export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        './vendor/masmerise/livewire-toaster/resources/views/*.blade.php',
    ],
  theme: {
    extend: {
        fontFamily: {
            'sans': ['Poppins', ...defaultTheme.fontFamily.sans],
            },
    },
  },
  plugins: [
    require('tailwind-scrollbar-hide')
  ],
}

