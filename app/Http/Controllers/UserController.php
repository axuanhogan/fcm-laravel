<?php

namespace App\Http\Controllers;

use \Carbon\Carbon;
use Response;
use Request;

// Services
use \App\Services\UserService;

class UserController extends Controller
{
    private $user_service;

    /**
     * Constructor
     */
    public function __construct(UserService $user_service)
    {
        $this->user_service = $user_service;
    }

    /**
     * 存放 Notification Token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveNotificationToken(): \Illuminate\Http\JsonResponse
    {
        $input = Request::all();
        $notification_token = $input['notificationToken'];

        // create single data to table user
        $this->user_service->createSingleData([
            'notification_token' => $notification_token,
        ]);

        return Response::json('Save token done.');
    }
}
