import './bootstrap';

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,    // ta clé Pusher
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true
});

window.Echo.channel('new-posts')
    .listen('.post.created', (e) => {
        console.log('Nouveau post en direct :', e);

        // ici tu peux incrémenter ton badge global
        let badge = document.getElementById('notif-badge');
        if (badge) {
            badge.innerText = parseInt(badge.innerText || 0) + 1;
        }
    });

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
