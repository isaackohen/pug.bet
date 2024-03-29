import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

require('./bootstrap');
const {Howl} = require('howler');
const feather = require('feather-icons');


feather.replace();

$.userId = function() {
    return window.Laravel.userId;
};

$.isGuest = function() {
    return window.Laravel.userId == null;
};

$.application = function() {
    return window.Laravel.application.toLowerCase();
};

$(document).ready(function() {
	
	let liveQueue = [];

    $.insertLiveGame = function(game) {
        liveQueue.push(game);
    };
	
	$.putNextInLiveQueue = function(force = false) {
        if(liveQueue.length === 0) return;
        const game = liveQueue[0];
        liveQueue.shift();
        const e = $(`<tr>
						<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
							<div class="flex items-center">
								<div class="flex-shrink-0 w-10 h-10">
									<img class="w-full h-full rounded-full shadow-inne"
									src="https://cdn.apigamble.com/i/long/jpg/${game.gameid}.jpg?width=20"
									alt="" />
								</div>
								<div class="ml-3">
									<p class="text-gray-900 whitespace-no-wrap font-semibold text-blue-600">
										<a href="/slots/real/${game.gameid}"}>
										${game.name}
										</a>
										<br>
										<span class="text-gray-600 text-xs font-medium whitespace-no-wrap">
										${game.provider}
										</span>
									</p>
								</div>
							</div>
						</td>
						<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
							<p class="cursor-pointer text-gray-900 whitespace-no-wrap font-semibold text-blue-600" wire:click="showUser('{{ $game->u }}')">
							${game.username}
							</p>
						</td>
						<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
							<p class="text-gray-900 whitespace-no-wrap">
								${parseFloat(game.bet).toFixed(2)}$
							</p>
						</td>
						<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
							${game.bet < game.win ?
							`<span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
								<span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>`
								:
								`<span class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
									<span aria-hidden class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>`
							}
									<span class="relative">${parseFloat(game.win).toFixed(2)}$</span>
								</span>
							</td>
						</td>
					</tr>`);
        e.hide();
        $('.livefeed').prepend(e);

        if(!force) {
            $('.livefeed').parent().find('tr').last().fadeOut(50, function() {
                $(this).delay(400).remove();
                e.fadeIn(400);
            });
        }
        else e.show();
    };


    setInterval($.putNextInLiveQueue, 150);
	
	window.Echo.channel(`${$.application()}_database_Everyone`)
	.listen('LiveFeed', function(data) {
		setTimeout(function() {
            $.insertLiveGame(data);
        }, data.delay);
	})
	.listen('PublicNotification', function(data) {
			var sound = new Howl({
			  src: [data.sound]
			});
			sound.play();

			window.$wireui.notify({
			    title: data.title,
			    description: data.message,
			    icon: data.icon,
			    timeout: '14500'
			})
	})

	if(!$.isGuest()) {
		window.Echo.channel(`${$.application()}_database_private-App.User.${$.userId()}`).listen('PlaySound', function(data) {
			var sound = new Howl({
			  src: [data.sound]
			});
			sound.play();
		});

		window.Echo.channel(`${$.application()}_database_private-App.User.${$.userId()}`).listen('BalanceModification', function(data) {
			$('#balance-id span').html(data.balance.toFixed(2));
		});
		window.Echo.channel(`${$.application()}_database_private-App.User.${$.userId()}`).listen('UserNotification', function(data) {
			window.$wireui.notify({
			    title: data.title,
			    description: data.message,
			    icon: data.icon,
			    timeout: '14500'
			})
		});
	}
});

