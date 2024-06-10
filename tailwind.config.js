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
    },
  },
  plugins: [],
};
