window._ = require('lodash');
window.$ = window.jQuery = require('jquery'); 

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
/*
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
*/

import Echo from 'laravel-echo';
//const token = localStorage.getItem('auth._token.local');


window.io = require('socket.io-client');

window.LaravelEcho = Echo;

const connect = function() {
    const error = function(callback) {
        let secondsLeft = 5 + 1;
        const timer = function() {
            secondsLeft--;
            console.log(secondsLeft);

            if(secondsLeft <= 0) {
                callback();
            } else setTimeout(timer, 5000);
        };
        timer();
    };

        window.Echo = new Echo({
			broadcaster: 'socket.io',
			host: window.host,
			path: '/ws/socket.io',
        });
};


connect();

$(document).ready(function () {
    $(".css-transitions-only-after-page-load").each(function (index, element) {
        setTimeout(function () { $(element).removeClass("css-transitions-only-after-page-load") }, 10);
    });
});
 
