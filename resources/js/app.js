require('./bootstrap');

require('alpinejs');

document.addEventListener("DOMContentLoaded", (event) => {
    document.getElementById('mobilemenu').classList.remove('hidden');
    document.getElementById('dark-overlay').classList.remove('hidden');
});
