## Introduction

This is my FCM demo with Laravel and RabbitMQ.

Set up the environment with docker-compose.

## Installation

1. Add your Firebase project ID to .env.example `FIREBASE_PROJECT_ID`.

2. Modify `/resources/js/fcm_job.js`
    ```js
    {
        apiKey: "{Your Firebase apiKey}",
        authDomain: "{Your Firebase authDomain}",
        projectId: "{Your Firebase projectId}",
        storageBucket: "{Your Firebase storageBucket}",
        messagingSenderId: "{your messagingSenderId}",
        appId: "{Your Firebase appId}",
        measurementId: "{Your Firebase measurementId}"
    }

    {
        vapidKey: "{Your FCM vapidKey}"
    }
    ```

3. Modify `/firebase-messaging-sw.js`
    ```js
    {
        apiKey: "{Your Firebase apiKey}",
        authDomain: "{Your Firebase authDomain}",
        projectId: "{Your Firebase projectId}",
        storageBucket: "{Your Firebase storageBucket}",
        messagingSenderId: "{your messagingSenderId}",
        appId: "{Your Firebase appId}",
        measurementId: "{Your Firebase measurementId}"
    }
    ```

4. Add your Firebase Admin SDK file `credentials.json` to root dir.

5. Run install.sh (about 5 ~ 8 mins), and then you will enter docker container.
    ```sh
    sh install.sh
    ```

## Basic Usage

- Open `localhost:81/public/index` & Publish default message to queue.
    ```sh
    php artisan publish
    ```

- You can：
    - See container info.
        ```sh
        docker ps
        ```
    - See DB info from phpmyadmin `localhost:8090`.
    - See Queue info from RabbitMQ `localhost:15673`.
    - Shutdown and remove container.
        ```sh
        docker-compose down
        ```

## Documentation
 1. [FCM Authorize send requests](https://firebase.google.com/docs/cloud-messaging/server)
 2. [bschmitt/laravel-amqp](https://github.com/bschmitt/laravel-amqp)
 3. [vladimir-yuldashev/laravel-queue-rabbitmq](https://github.com/vyuldashev/laravel-queue-rabbitmq)