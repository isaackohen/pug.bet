const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    mode: 'jit',
    purge: [
        "./config/livewire-notifier.php",
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    theme: {

        extend: {

                colors: {},
    textColor: {
      primary: 'var(--color-text-primary)',
      primaryfocus: 'var(--color-text-primary-focus)',
      secondary: 'var(--color-text-secondary)',
      default: 'var(--color-text-default)',
      'default-soft': 'var(--color-text-default-soft)',
      inverse: 'var(--color-text-inverse)',
      'inverse-soft': 'var(--color-text-inverse-soft)',
    },
    backgroundColor: {
      primary: 'var(--color-bg-primary)',
      secondary: 'var(--color-bg-secondary)',
      component: 'var(--color-bg-component)',

      default: 'var(--color-bg-default)',
      inverse: 'var(--color-bg-inverse)',
    },
    fontWeights: {
      normal: 'var(--font-weight-normal)',
      display: 'var(--font-weight-display)',
      btn: 'var(--font-weight-btn)',
    },
    borderRadius: {
      none: '0',
      component: 'var(--rounded-component)',
    },
    boxShadow: {
        component:  'var(--box-shadow-component)',
    },

   fontFamily: {
      display: 'var(--font-display)',
      bodysans: 'var(--font-body-sans)',

      body: 'var(--font-body)',
    },

        },
    },
    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
