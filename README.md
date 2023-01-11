## Introduction

This is my FCM demo, set up the environment with docker-compose

## Installation

1. Add your Firebase Admin SDK file `credentials.json` to root dir

2. Run install.sh, and then you will enter docker container
    ```sh
    sh install.sh
    ```

## Basic Usage

- Publish default message to queue
    ```sh
    php artisan publish
    ```

- You can
    - See container info
        ```sh
        docker ps
        ```
    - See DB info from phpmyadmin `localhost:8090`
    - See Queue info from RabbitMQ `localhost:15673`

## Documentation
 1. [FCM Authorize send requests](https://firebase.google.com/docs/cloud-messaging/server)
 2. [bschmitt/laravel-amqp](https://github.com/bschmitt/laravel-amqp)
 3. [vladimir-yuldashev/laravel-queue-rabbitmq](https://github.com/vyuldashev/laravel-queue-rabbitmq)