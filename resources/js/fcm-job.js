import { initializeApp } from "firebase/app";
import { getMessaging, getToken } from "firebase/messaging";

const firebaseConfig = {
    apiKey: "{Your Firebase apiKey}",
    authDomain: "{Your Firebase authDomain}",
    projectId: "{Your Firebase projectId}",
    storageBucket: "{Your Firebase storageBucket}",
    messagingSenderId: "{your messagingSenderId}",
    appId: "{Your Firebase appId}",
    measurementId: "{Your Firebase measurementId}"
};
const app = initializeApp(firebaseConfig);

const messaging = getMessaging(app);
let permissionContent = document.getElementById('permission-content');
let tokenContent = document.getElementById('token-content');

Notification.requestPermission()
.then((permission) => {
    if (permission === 'granted') {
        console.log('Notification permission granted.');
        permissionContent.innerText = 'Notification permission granted.';
        return getToken(messaging, {
            vapidKey: "{Your FCM vapidKey}"
        })
    }
})
.then((notificationToken) => {
    console.log(notificationToken);
    if (notificationToken) {
        let csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        fetch('user/save-notification-token', {
            method: "POST",
            headers: {
                'content-type': 'apllication/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify({
                "notificationToken": notificationToken
            })
        })
        .then(response => {
            return response.json();
        })
        .then(result => {
            console.log(result);
            tokenContent.innerText = result;
        });
    } else {
        console.log('No registration token available. Request permission to generate one.');
        tokenContent.innerText = 'No registration token available. Request permission to generate one.';
    }
})
.catch((error) => {
    console.log('An error occurred while retrieving token. ', error);
    tokenContent.innerText = 'An error occurred while retrieving token. ', error;
});