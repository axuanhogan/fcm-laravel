<?php

namespace App\Console\Commands;

use \Bschmitt\Amqp\Facades\Amqp;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Console\Command;

// Jobs
use \App\Jobs\FCMJob;

// Services
use \App\Services\FCMJobService;

class PublishAMQP extends Command
{
    use DispatchesJobs;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'publish message';

    private $fcm_job_service;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(FCMJobService $fcm_job_service)
    {
        parent::__construct();
        $this->fcm_job_service = $fcm_job_service;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $data = [
            'identifier' => 'fcm-msg-a1beff5ac',
            'type' => 'web',
            'deviceId' => 'test device',
            'string' => 'message',
        ];
        Amqp::publish('fcm_job', json_encode($data) , ['queue' => 'notification.fcm']);

        Amqp::consume('notification.fcm', function ($message, $resolver) {
            $payload = json_decode($message->getBody(), true);
            dispatch(new FCMJob($payload, $this->fcm_job_service));
            $resolver->acknowledge($message);
            $resolver->stopWhenProcessed();
        });

        return true;
    }
}
