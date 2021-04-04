require('./bootstrap');

require('alpinejs');

const shareThis = require("share-this");
const twitter = require("share-this/dist/sharers/twitter");
const facebook = require("share-this/dist/sharers/facebook");

const selectionShare = shareThis.default({
    selector: "#article-content",
    sharers: [twitter, facebook]
});

selectionShare.init();

document.addEventListener("DOMContentLoaded", (event) => {
    document.getElementById('mobilemenu').classList.remove('hidden');
    document.getElementById('dark-overlay').classList.remove('hidden');
});
