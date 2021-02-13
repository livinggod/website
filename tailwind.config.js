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
                15: '15rem',
                120: '30rem'
            },
            minHeight: {
                80: '20rem',
                120: '30rem'
            },
            zIndex: {
                60: '60',
            },
            typography: {
                DEFAULT: {
                    css: {
                        a: {
                            color: '#6B7280',
                            '&:hover': {
                                color: '#374151',
                            },
                        },
                    },
                },
            }
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
