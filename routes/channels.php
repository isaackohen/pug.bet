<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('Everyone', function() {
    return true;
});

Broadcast::channel('App.User.{id}', function ($user, $id) {
    if($id === 'Guest') return true;
    return auth()->guest() ? false : $user->_id === $id;
});
