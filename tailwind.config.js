const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: ['./storage/framework/views/*.php', './resources/views/**/*.blade.php'],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                custom: {
                    green: {
                        100: '#59B100'
                    }
                }
            },
            height: {
                40: '40vh'
            },
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
            animation: ['responsive', 'motion-safe', 'motion-reduce']
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography'),],
};
