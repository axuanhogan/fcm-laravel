<?php

namespace App\Services;

// Respositories
use \App\Repositories\FCMJobRepository;

class FCMJobService
{
    private $fcm_job_repo;

    /**
     * Constructor
     */
    public function __construct(FCMJobRepository $fcm_job_repo)
    {
        $this->fcm_job_repo = $fcm_job_repo;
    }

    /**
     * Create single data
     *
     * @return bool
     */
    public function createSingleData(array $data): bool
    {
        $result = $this->fcm_job_repo->createSingle($data);
        return !empty($result);
    }
}
