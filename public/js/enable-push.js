initSW();

const applicationServerPublicKey = 'BPu7vF6d9MfLdxYOQEwCSOQV4mS91XSNIO-1DmilVgz5CtYKHIkmIyKr1eaoTvwce7iDSI5dCwnkMoEIdUrPkXI';

function initSW() 
{
    if ('serviceWorker' in navigator && 'PushManager' in window) 
    {
        console.log('Service Worker and Push is supported');

        navigator.serviceWorker.register('http://localhost/laravel_5_8/travel_blog/public/js/service-worker.js')
            .then(function(swReg) {

                console.log('Service Worker is registered', swReg);
                swReg.update();

                swRegistration = swReg;
                initializeUI();
            })
            .catch(function(error) {
                console.error('Service Worker Error', error);
            });
    } 
    else 
    {
        console.warn('Push messaging is not supported');
        pushButton.textContent = 'Push Not Supported';
    }
}

function initializeUI() 
{
    subscribeUser();

    // Set the initial subscription value
    swRegistration.pushManager.getSubscription()
        .then(function(subscription) {

        isSubscribed = !(subscription === null);

        if (isSubscribed) 
        {
            console.log('User is subscribed.');
        } 
        else 
        {
            console.log('User is NOT subscribed.');
        }

        });
}

function subscribeUser() 
{
    const applicationServerKey = urlB64ToUint8Array(applicationServerPublicKey);

    swRegistration.pushManager.subscribe({

        userVisibleOnly: true,
        applicationServerKey: applicationServerKey
    })
        .then(function(subscription) {

            console.log(JSON.stringify(subscription));

            storePushSubscription(subscription);
        })
        .catch(function(err) {
            console.log('Failed to subscribe the user: ', err);
        });
}

function urlB64ToUint8Array(base64String) 
{
    const padding = '='.repeat((4 - base64String.length % 4) % 4);
    const base64  = (base64String + padding)
        .replace(/\-/g, '+')
        .replace(/_/g, '/');

    const rawData     = window.atob(base64);
    const outputArray = new Uint8Array(rawData.length);

    for (let i = 0; i < rawData.length; ++i) 
    {
        outputArray[i] = rawData.charCodeAt(i);
    }

    return outputArray;
}


function storePushSubscription(pushSubscription) 
{
    const token = document.querySelector('meta[name=csrf-token]').getAttribute('content');

    fetch('http://localhost/laravel_5_8/travel_blog/public/notification', {
        method: 'POST',
        body: JSON.stringify(pushSubscription),
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-Token': token,
            'Authorization': 'Bearer ' + window.token,
        }
    })
    .then((res) => {
        return res.json();
    })
    .then((res) => {
        console.log(res)
    })
    .catch((err) => {
        console.log(err)
    });
}
