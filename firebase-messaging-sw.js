importScripts("https://www.gstatic.com/firebasejs/9.15.0/firebase-app-compat.js");
importScripts("https://www.gstatic.com/firebasejs/9.15.0/firebase-messaging-compat.js");

firebase.initializeApp({
    apiKey: "AIzaSyDwaID5Y78qSeIHssB9Fxn5vkVHbJQyfc4",
    authDomain: "my-firebase-project-cf124.firebaseapp.com",
    projectId: "my-firebase-project-cf124",
    storageBucket: "my-firebase-project-cf124.appspot.com",
    messagingSenderId: "497560878505",
    appId: "1:497560878505:web:317fb6e772edd6f935d8b8",
    measurementId: "G-JPCGTLSV1B"
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
