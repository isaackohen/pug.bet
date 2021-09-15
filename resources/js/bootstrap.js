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
import VanillaTilt from 'vanilla-tilt';


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
$.request = function(route, options = [], type = 'post', timeout = 25000) {
    const url = `${!route.startsWith('/') ? '/api/' : ''}${route + (type === 'get' ? arrayToRouteParams(options) : '')}`;
    return new Promise(function(resolve, reject) {
        $.ajax({
            url: url,
            type: type.toUpperCase(),
            data: type.toLowerCase() === 'get' ? [] : options,
            dataType: 'json',
            timeout: timeout,
            success: (json) => handleApiResponse(url, json, resolve, reject),
            error: function(data) {
                if(data.status === 500) {
                    console.error('Failed request (500)');
                    reject(0);

                    if(typeof $.error === "function") {
                        $.error($.lang('error.code', {'code': 500}));
                        $.blockPlayButton(false);
                    }
                } else if(data.status === 422) {
                    console.log('Failed validation (422):');
                    let json = JSON.parse(data.responseText);
                    console.log(json.message);
                    console.log(json.errors);
                    reject(json.errors);
                } else if(data.status !== 0) {
                    console.error(`Failed request (${data.status}):`);
                    console.error(`Route ${route + arrayToRouteParams(options)} is unreachable`);
                    reject(-1);
                } else {
                    console.error(`Route ${route + arrayToRouteParams(options)} timed out (${timeout}ms)`);
                    reject(0);
                }
            }
        });
    })
};

function handleApiResponse(url, json, resolve, reject) {
    if(json.message != null && json.errors != null) {
        reject(0);
        return;
    }

    if(json.error != null) {
        if(json.error[0] === -1024) {
            console.log(url, '-1024', '2FA session expired');

            $.tfa(function() {
                $.request(route, options, type).then(function(response) {
                    resolve(response);
                }, function(error) {
                    reject(error);
                });
            });
            return;
        } else console.error(url, json.error[0] + ' > ' + json.error[1]);
        reject(json.error[0]);
        return;
    }

    console.log(url, json);
    resolve(json.response);
}

$.formDataRequest = function(route, options) {
    return new Promise(function(resolve, reject) {
        $.ajax({
            url: `${!route.startsWith('/') ? '/api/' : ''}${route}`,
            type: 'POST',
            data: options,
            contentType: false,
            processData: false,
            success: function() {
                resolve();
            },
            error: function(data) {
                reject(data);
            }
        });
    })
};
    $('[data-key]').on('input', function() {
        $.request('/admin/settings/edit', {
            key: $(this).attr('data-key'),
            value: $(this).val().length === 0 ? 'null' : $(this).val()
        });
    });

    $('#finish').on('click', function() {
        $('#close').click();
        $.request('/admin/settings/create', {
            key: $('#key').val(),
            description: $('#description').val()
        }).then(function() {
            $('.modal-backdrop').remove();
            redirect(window.location.pathname);
        }, function(error) {});
    });

    $('[data-remove]').on('click', function() {
        $.request('/admin/settings/remove', {
            'key': $(this).attr('data-remove')
        }).then(function() {
            redirect(window.location.pathname);
        });
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
  