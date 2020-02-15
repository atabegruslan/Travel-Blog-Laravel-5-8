importScripts('https://www.gstatic.com/firebasejs/7.8.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.8.0/firebase-messaging.js');
importScripts('firebase-config.js');

firebase.initializeApp(firebaseConfig);

const messaging = firebase.messaging();

messaging.setBackgroundMessageHandler(function(payload) {
	console.log('[firebase-messaging-sw.js] Received background message ', payload);
	// Customize notification here
	const notificationTitle = 'Background Message Title';
	const notificationOptions = {
		body: 'Background Message body.',
		icon: '/firebase-logo.png'
	};

	return self.registration.showNotification(notificationTitle, notificationOptions);
});

self.addEventListener('notificationclick', function(event) {
	
    console.log({event});

    // var notification = event.notification;
    // var data         = notification.data;
    // var action       = event.action;

    // if (action === 'close')
    // {
    //     notification.close();
    // }
    // else if (action === 'view')
    // {
    //     event.waitUntil(
    //         clients.openWindow(data.entry_url)
    //     );
    // }
    // else
    // {
    //     event.waitUntil(
    //         clients.openWindow(data.base_url)
    //     );
    // }
}, false);

self.addEventListener('notificationclose', function(event) {

    console.log({event});

    // var notification   = event.notification;
    // var notificationId = notification.tag;

    // console.log(`Closed notification: ${notificationId}`);
});
