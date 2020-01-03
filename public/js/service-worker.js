self.addEventListener('notificationclick', function (event) {
    
    console.log('[Service Worker] Notification click Received.');
    console.dir(event);//test

    event.notification.close();

    event.waitUntil(
        clients.openWindow(event.action)
    );
});

self.addEventListener('push', function (e) {

    console.dir(e);//test

    if (!(self.Notification && self.Notification.permission === 'granted')) 
    {
        console.log('notifications aren\'t supported or permission not granted!');

        return;
    }

    if (e.data) 
    {
        var msg = e.data.json();
        console.log(msg);
        
        e.waitUntil(self.registration.showNotification(msg.title, {
            body: msg.body,
            icon: msg.icon,
            actions: msg.actions
        }));
    }
});