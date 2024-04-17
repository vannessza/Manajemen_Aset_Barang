/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "node_modules/preline/dist/*.js",
  ],
  theme: {
    extend: {},
  },
  theme: {
    container:{
      center: true,
      padding: '16px'
    },
    extend: {
      colors: {
        primary: '#008d8d',
      },
      screens: {
        '2xl': '1320px'
      }
    },
  },
  plugins: [
    require('preline/plugin'),
  ],
  
}

