firebase.initializeApp(firebaseConfig);

const messaging = firebase.messaging();

registerServiceWorker();

function registerServiceWorker()
{ // https://stackoverflow.com/questions/41659970/firebase-change-the-location-of-the-service-worker
    if ('serviceWorker' in navigator && 'PushManager' in window) 
    {
        navigator.serviceWorker.getRegistration()
            .then(function(registration) {

                if (registration)
                {
					messaging.useServiceWorker(registration);
					getPermission();
                }
                else
                {
                    navigator.serviceWorker.register(baseUrl + 'js/firebase-service-worker.js')
                        .then(function(newRegistration) {

							messaging.useServiceWorker(newRegistration);
							getPermission();
                        })
                        .catch(function(error) {
                            console.error({error});
                        });
                }
            });
    } 
    else 
    {
        console.warn('Service Worker and Push Messaging are not supported');
    }
}

function getPermission()
{
	messaging.requestPermission()
		.then(function() {
			console.log('Notification permission granted');

			if (isTokenSentToServer())
			{
				console.log('Token already saved');
			}
			else
			{
				getRegToken();
			}
		})
		.catch(function(err) {
			console.error(err);
		});
}

function getRegToken()
{
	messaging.getToken().then((currentToken) => {
		if (currentToken) 
		{
			saveToken(currentToken);
			console.log({currentToken});
		} 
		else 
		{
			console.log('No Instance ID token available. Request permission to generate one.');
			setTokenSentToServer(false);
		}
	}).catch((err) => {
		console.log('An error occurred while retrieving token. ', err);
		setTokenSentToServer(false);
	});
}

function setTokenSentToServer(sent) 
{
	window.localStorage.setItem('sentToServer', sent ? '1' : '0');
}

function isTokenSentToServer() 
{
	return window.localStorage.getItem('sentToServer') === '1';
}

function saveToken(fcmToken) 
{
	const token = document.querySelector('meta[name=csrf-token]').getAttribute('content');

    fetch(baseUrl + 'notification/firebase', {
        method : 'POST',
        body   : JSON.stringify({'token':fcmToken}),
        headers: {
            'Accept'       : 'application/json',
            'Content-Type' : 'application/json',
            'X-CSRF-Token' : token,
            'Authorization': 'Bearer ' + window.token,
        }
    })
    .then((res) => {
        return res.json();
    })
    .then((res) => {
        console.log(res);
        setTokenSentToServer(true);
    })
    .catch((error) => {
        console.error(error)
    });
}

// If you want the service worker's setBackgroundMessageHandler to be called, then below is not necessary.
// messaging.onMessage(function(payload) {

// 	console.log({payload});

// 	var options = {
// 		icon   : payload.data.icon,
// 		body   : payload.data.body,
// 		data   : payload.data.data,
// 		dir    : payload.data.dir,
// 		image  : payload.data.image,
// 		lang   : payload.data.lang,
// 		tag    : payload.data.tag,
// 		//actions: $.parseJSON(payload.data.actions), // Don't use actions here. Otherwise you will get: TypeError: Failed to construct 'Notification': Actions are only supported for persistent notifications shown using ServiceWorkerRegistration.showNotification().
// 		vibrate: payload.data.vibrate
// 	};

// 	var notification = new Notification(payload.data.title, options);

// 	notification.onclick = function(event) {
// 	  console.log({event});
// 	};

// 	notification.onerror = function(event) {
// 	  console.error(event);
// 	};
// });
