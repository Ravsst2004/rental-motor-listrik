/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.{html,js,php}", // Menangkap file di root direktori
    "./src/**/*.{html,js,php}", // Menangkap file di dalam direktori src
    "./src/layouts/**/*.{html,js,php}", // Menangkap file di dalam src/layouts
  ],
  theme: {
    extend: {
      fontFamily: {
        poppins: ["Poppins", "sans-serif"],
      },
      colors: {
        primary: "#254336",
        secondary: "#6B8A7A",
        tertiary: "#6B8A7A",
        quaternary: "#DAD3BE",
      },
    },
  },
  plugins: [],
};
