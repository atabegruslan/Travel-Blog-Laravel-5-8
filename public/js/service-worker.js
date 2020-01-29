self.addEventListener('push', function (e) {

    if (!(self.Notification && self.Notification.permission === 'granted')) 
    {
        console.warn('notifications aren\'t supported or permission not granted!');

        return;
    }

    if (e.data) 
    {
        var msg = e.data.json();
        console.log({msg});

        var options = {
            body   : msg.body,
            icon   : msg.icon,
            // actions: [
            //     {action: 'explore', title: 'Go to the site', icon: 'check.png'},
            //     {action: 'close', title: 'No thanks', icon: 'x.png'},
            // ],
            //vibrate: [100, 50, 100],
            //data   : {primaryKey: 1}
        };
        
        e.waitUntil(
            self.registration.showNotification(msg.title, options)
        );
    }
});

self.addEventListener('notificationclick', function (event) {
    
    var notification = event.notification;
    var action       = event.action;

    if (action === 'close')
    {
        notification.close();
    }
    else
    {
        event.waitUntil(
            clients.openWindow('https://www.google.com')
        );
    }
});

self.addEventListener('notificationclose', function (event) {

    // var notification = event.notification;
    // var primaryKey   = notification.data.primaryKey;

    // console.log(`Closed notification: $(primaryKey)`);
});
