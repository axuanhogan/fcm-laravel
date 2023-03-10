importScripts("https://www.gstatic.com/firebasejs/9.15.0/firebase-app-compat.js");
importScripts("https://www.gstatic.com/firebasejs/9.15.0/firebase-messaging-compat.js");

firebase.initializeApp({
    apiKey: "{Your Firebase apiKey}",
    authDomain: "{Your Firebase authDomain}",
    projectId: "{Your Firebase projectId}",
    storageBucket: "{Your Firebase storageBucket}",
    messagingSenderId: "{your messagingSenderId}",
    appId: "{Your Firebase appId}",
    measurementId: "{Your Firebase measurementId}"
});

const messaging = firebase.messaging();

messaging.onMessage(function(payload) {
    console.log('Message received. ', payload);
});

messaging.onBackgroundMessage(function(payload) {
    console.log('[firebase-messaging-sw.js] Received background message ', payload);

    const notificationTitle = 'Background Message Title';
    const notificationOptions = {
        body: 'Background Message body.',
        icon: '/firebase-logo.png'
    };

    self.registration.showNotification(notificationTitle, notificationOptions);
});
