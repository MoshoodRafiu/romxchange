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

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('trade.{id}', function ($user, $id) {
    $trade = \App\Trade::find($id);
    if ($trade->is_special == 0){
        return (((int) $user->id === (int) $trade->buyer_id) || ((int) $user->id === (int) $trade->seller_id) || ((int) $user->id === (int) $trade->agent_id) || ($user->is_admin == 1));
    }else{
        return (((int) $user->id === (int) $trade->buyer_id) || ((int) $user->id === (int) $trade->seller_id) || ($user->is_admin == 1));
    }
});
