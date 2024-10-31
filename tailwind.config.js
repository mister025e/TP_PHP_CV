/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './app//*.{php,html}',    // Include all the PHP et HTML files in app folder
    './app/styles.css',         // Include main CSS file if using classes Tailwind inside
  ],
  theme: {
    extend: {},
  },
  plugins: [
    //require('@tailwindcss/forms'),
  ],
}