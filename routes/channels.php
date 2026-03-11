<?php

use App\Models\Client;
use App\Models\Restaurant;
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

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});


Broadcast::channel('chat-channel.{restaurantId}', function (Restaurant $restaurant, $restaurantId) {
    return (int) $restaurant->id === (int) $restaurantId;
});

Broadcast::channel('chat-channel.{clientId}', function (Client $client, $clientId) {
    return (int) $client->id === (int) $clientId;
});