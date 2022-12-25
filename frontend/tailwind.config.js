/** @type {import('tailwindcss').Config} */

const palette = require("./src/assets/palette");

module.exports = {
  content: ["./index.html", "./src/**/*.{vue,js,ts,jsx,tsx}"],
  theme: {
    extend: {
      colors: palette,
      fontFamily: {
        regular: ["RobotoRegular"],
        medium: ["RobotoMedium"],
        bold: ["RobotoBold"],
        black: ["RobotoBlack"],
      },
    },
  },
  plugins: [],
};
