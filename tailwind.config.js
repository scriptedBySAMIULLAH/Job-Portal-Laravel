/** @type {import('tailwindcss').Config} */

export default {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  theme: {
    extend: {
      boxShadow:{

        bottom:'0 6px 1px 1px rgba(0,128,128,0.5)'
      }


    },
    fontFamily: {
      'body': ['Poppins', 'sans-serif'],
      montserrat: ['Montserrat', 'sans-serif'],
      lora: ['Lora', 'serif'],
      Roboto: ['Roboto'],
    },
  
  },
  
  plugins: [],
  
}
