/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      width: {
        '18': '5rem'
      },
      height: {
        '18': '3.8rem'
      },
      fontSize: {
        'x': '.6rem'
      }
    },
  },
  plugins: [
    // require('tailwindcss')
  ],
}