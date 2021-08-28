require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
const feather = require('feather-icons');
feather.replace()


Echo.channel(`my-channel`)
    .listen('my-event', (e) => {
        console.log('works');
    });