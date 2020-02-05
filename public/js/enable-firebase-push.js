firebase.initializeApp(firebaseConfig);

const messaging = firebase.messaging();

init();

function init()
{ // https://stackoverflow.com/questions/41659970/firebase-change-the-location-of-the-service-worker
	navigator.serviceWorker.register(baseUrl + 'js/firebase-service-worker.js')
		.then((registration) => {
			messaging.useServiceWorker(registration);

			getPermission();
		});
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

messaging.onMessage(function(payload) {
	console.log({payload});

	// var notification = new Notification(payload.data.title, {
	// 	body: payload.data.body
	// });
});