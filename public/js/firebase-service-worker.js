importScripts('https://www.gstatic.com/firebasejs/7.8.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.8.0/firebase-messaging.js');
importScripts('http://localhost/laravel_5_8/travel_blog/public/js/firebase-config.js');

firebase.initializeApp(firebaseConfig);

const messaging = firebase.messaging();

// messaging.setBackgroundMessageHandler(function(payload) {
// 	console.log('[firebase-messaging-sw.js] Received background message ', payload);
// 	// Customize notification here
// 	const notificationTitle = 'Background Message Title';
// 	const notificationOptions = {
// 		body: 'Background Message body.',
// 		icon: '/firebase-logo.png'
// 	};

// 	return self.registration.showNotification(notificationTitle, notificationOptions);
// });
