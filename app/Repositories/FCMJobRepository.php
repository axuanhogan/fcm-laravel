<?php

namespace App\Repositories;

// Models
use \App\Models\FCMJob as ModelFCMJob;

class FCMJobRepository
{
    private $fcm_job_model;

    /**
     * Constructor
     */
    public function __construct(ModelFCMJob $fcm_job_model)
    {
        $this->fcm_job_model = $fcm_job_model;
    }

    /**
     * Create single data
     *
     * @return ModelFCMJob
     */
    public function createSingle(array $data): ModelFCMJob
    {
        return $this->fcm_job_model->create($data);
    }
}
