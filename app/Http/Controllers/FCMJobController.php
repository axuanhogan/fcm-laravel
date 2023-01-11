<?php

namespace App\Http\Controllers;

use \Carbon\Carbon;
use Response;
use Request;

// Jobs
use \App\Jobs\FCMJob;

// Services
use \App\Services\FCMJobService;

class FCMJobController extends Controller
{
    private $fcm_job_service;

    /**
     * Constructor
     */
    public function __construct(FCMJobService $fcm_job_service)
    {
        $this->fcm_job_service = $fcm_job_service;
    }

    /**
     * Index page
     *
     * @return \Illuminate\View\View
     */
    public function index(): \Illuminate\View\View
    {
        return view('fcm-job', []);
    }

    /**
     * Push message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function push(): \Illuminate\Http\JsonResponse
    {
        // get input
        $input = Request::input();

        // put in queue
        $this->dispatch(new FCMJob($input, $this->fcm_job_service));

        $result = [
            'message' => 'send done'
        ];
        return Response::json($result);
    }
}
