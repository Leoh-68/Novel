/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./src/views/**/*.{php,js}"],
  darkMode: ['variant', '&:not(.light-style *)'],
  theme: {
    extend: {
      colors: {
        'main': '#06743C'
      },
      lineClamp: {
        7: '7',
        8: '8',
        9: '9',
      },
    },
    screens: {
      'sm': '640px',
      'md': '768px',
      'lg': '1024px',
      'xl': '1280px',
      '2xl': '1536px',
    },
    animatedSettings: {
      animatedSpeed: 1000,
      heartBeatSpeed: 500,
      hingeSpeed: 2000,
      bounceInSpeed: 750,
      bounceOutSpeed: 750,
      animationDelaySpeed: 500,
      classes: ['bounce', 'bounceIn']
    }
  },
  plugins: [
    require('@tailwindcss/line-clamp'),
    require('@tailwindcss/forms'),
    require('tailwindcss-animatecss'),
  ],
}

