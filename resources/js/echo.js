/* import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});
 */

import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true,
    authEndpoint: '/broadcasting/auth'
});

window.Echo.private(`chat-channel.${userId}`)
    .listen('MessageSendEvent', (event) => {
        Livewire.find('chat-component-client').listenForMessage(event);
    });

window.Echo.private(`chat-channel.${restaurantId}`)
    .listen('MessageSendEvent', (event) => {
        Livewire.find('chat-component-restaurant').listenForMessage(event);
    });

window.Echo.join(`chat-channel.${userId}`)
    .here((users) => {
        Livewire.find('chat-component-client').listenForUsers(users);
    })
    .joining((user) => {
        Livewire.find('chat-component-client').listenForUser(user);
    })
    .leaving((user) => {
        Livewire.find('chat-component-client').removeUser(user);
    })

window.Echo.join(`chat-channel.${restaurantId}`)
    .here((users) => {
        Livewire.find('chat-component-restaurant').listenForUsers(users);
    })
    .joining((user) => {
        Livewire.find('chat-component-restaurant').listenForUser(user);
    })
    .leaving((user) => {
        Livewire.find('chat-component-restaurant').removeUser(user);
    })