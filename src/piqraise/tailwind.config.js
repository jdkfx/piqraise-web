module.exports = {
  purge: [
    './storage/framework/views/*.php',
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      colors: {
        'piq-green': {
          white: '#F4F9F4',
          light: '#A7D7C5',
          DEFAULT: '#77B255',
          dark: '#436530',
        },
      },
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
