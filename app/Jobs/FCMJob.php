<?php

namespace App\Jobs;

use \Carbon\Carbon;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Queueable;

// Services
use \App\Services\FCMJobService;
use \App\Services\UserService;

class FCMJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    const OAUTH_FILE = 'credentials.json';
    const SCOPE = [
        'messaging' => 'https://www.googleapis.com/auth/firebase.messaging'
    ];

    private $input;
    private $fcm_job_service;
    private $user_service;

    /**
     * Create a new job instance.
     *
     * @param array $input
     * @return void
     */
    public function __construct(array $input, FCMJobService $fcm_job_service, UserService $user_service)
    {
        $this->input = $input;
        $this->fcm_job_service = $fcm_job_service;
        $this->user_service = $user_service;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        $notification_token = $this->user_service->getNotificationToken();

        // get access token
        $client = new \Google_Client();
        $client->setAuthConfig(base_path() . '/' . static::OAUTH_FILE);
        $client->addScope(static::SCOPE['messaging']);
        $client->refreshTokenWithAssertion();
        $access_token = $client->getAccessToken()['access_token'];

        // set params & headers
        $params = json_encode([
            'message' => [
                'token' => $notification_token,
                'notification' => [
                    'title'	=> 'Incoming message',
                    'body' 	=> 'text'
                ]
            ]
        ]);
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer '. $access_token
        ];

        // curl fcm message send
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://fcm.googleapis.com/v1/projects/' . env('FIREBASE_PROJECT_ID') . '/messages:send');
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        $curl_result = curl_exec($curl);
        curl_close($curl);

        // create single data to table fcm_job
        $this->fcm_job_service->createSingleData([
            'identifier' => $this->input['identifier'],
            'message' => $params,
            'fcm_result' => $curl_result,
            'deliver_at' => Carbon::now()->toDateTimeString(),
        ]);
    }
}
