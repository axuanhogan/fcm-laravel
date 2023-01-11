@extends('layout.fcm-job.main')

@section('HeadContent')
    <style>
    </style>
@stop

@section('BodyContent')
    {{ Form::open(['url' => action('FCMJobController@push'), 'method' => 'post' , 'files' => false]) }}
        <input type="submit" value="Push">
        <input id="messaging-token" type="hidden" name="messaging_token">
    {{ Form::close() }}
@stop

@section('FooterContent')
    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/9.15.0/firebase-app.js";
        import { getMessaging, getToken } from "https://www.gstatic.com/firebasejs/9.15.0/firebase-messaging.js";

        const firebaseConfig = {
            apiKey: "{{ env('MY_FIREBASE_PROJECT_NOTIFICATION_API_KEY') }}",
            authDomain: "{{ env('MY_FIREBASE_PROJECT_NOTIFICATION_AUTH_DOMAIN') }}",
            projectId: "{{ env('MY_FIREBASE_PROJECT_NOTIFICATION_PROJECT_ID') }}",
            storageBucket: "{{ env('MY_FIREBASE_PROJECT_NOTIFICATION_STORAGE_BUCKET') }}",
            messagingSenderId: "{{ env('MY_FIREBASE_PROJECT_NOTIFICATION_MESSAGING_SENDER_ID') }}",
            appId: "{{ env('MY_FIREBASE_PROJECT_NOTIFICATION_APP_ID') }}",
            measurementId: "{{ env('MY_FIREBASE_PROJECT_NOTIFICATION_MEASUREMENT_ID') }}"
        };
        const app = initializeApp(firebaseConfig);

        const messaging = getMessaging(app);

        Notification.requestPermission()
        .then((permission) => {
            if (permission === 'granted') {
                console.log('Notification permission granted.');
                return getToken(messaging, {vapidKey: "{{ env('MY_FIREBASE_PROJECT_FCM_VAPID_KEY') }}"})
            }
        })
        .then((currentToken) => {
            if (currentToken) {
                document.getElementById('messaging-token').value = currentToken;
            } else {
                console.log('No registration token available. Request permission to generate one.');
            }
        })
        .catch((error) => {
            console.log('An error occurred while retrieving token. ', error);
        });
    </script>
@stop
