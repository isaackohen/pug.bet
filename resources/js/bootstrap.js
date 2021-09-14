window._ = require('lodash');
window.$ = window.jQuery = require('jquery'); 

require("slick-carousel");


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

    $(document).ready(function() {
        $('#slider').slick({
            infinite: true,
            arrows: false,
            speed: 500,
            cssEase: 'cubic-bezier(0.175, 0.885, 0.320, 1.275)',
            autoplay: 9500,
            appendDots: "#dotted"
        });
    });
  

    $(document).ready(function() {
          
    $('#c1').slick({
          dots: false,
          infinite: true,
          lazyLoad: "progressive",
          useTransform: true,
          arrows: true,
          speed: 500,
          cssEase: 'cubic-bezier(0.175, 0.885, 0.320, 1.275)',
          appendArrows: "#c1-arrows",
          prevArrow: '<div class="slick-arrows-styled cursor-pointer text-primary mr-2" style="border-radius: 15px 0 0 15px;"><span class="fas fa-long-arrow-left"></span><span class="sr-only">Prev</span></div>',
          nextArrow: '<div class="slick-arrows-styled cursor-pointer text-primary mr-2" style="border-radius: 0 15px 15px 0;"><span class="fas fa-long-arrow-right"></span><span class="sr-only">Next</span></div>',
          slidesToScroll: 3,
          slidesToShow: 6,

          responsive: [
            {
              breakpoint: 1224,
              settings: {
                slidesToShow: 5,
                slidesToScroll: 2,
              }
            },
            {
              breakpoint: 925,
              settings: {
                slidesToShow: 4,
                slidesToScroll: 2
              }
            },
            {
              breakpoint: 775,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 2
              }
            },
            {
              breakpoint: 620,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 1
              }
            },
            {
              breakpoint: 490,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 1
              }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
          ]
        });
    });
  