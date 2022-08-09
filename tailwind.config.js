/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      zIndex: {
        '100': '100',
      },
    },
    container: {
      center: true,
    },
    screens: {
      'v-sm': '400px',
      'sm': '600px',
      'md': '768px',
      'lg': '980px',
      'xl': '1168px',
      'xxl': '1380px',
      '2xl': '1536px',
    }
  },
  plugins: [],
}
