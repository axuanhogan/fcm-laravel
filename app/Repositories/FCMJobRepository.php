<?php

namespace App\Repositories;

// Models
use \App\Models\FCMJobModel;

class FCMJobRepository
{
    private $fcm_job_model;

    /**
     * Constructor
     */
    public function __construct(FCMJobModel $fcm_job_model)
    {
        $this->fcm_job_model = $fcm_job_model;
    }

    /**
     * Create single data
     *
     * @return FCMJobModel
     */
    public function createSingle(array $data): FCMJobModel
    {
        return $this->fcm_job_model->create($data);
    }
}
