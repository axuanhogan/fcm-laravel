<?php

namespace App\Repositories;

// Models
use \App\Models\UserModel;

class UserRepository
{
    private $user_model;

    /**
     * Constructor
     */
    public function __construct(UserModel $user_model)
    {
        $this->user_model = $user_model;
    }

    /**
     * Create single data
     *
     * @return UserModel
     */
    public function createSingle(array $data): UserModel
    {
        return $this->user_model->firstOrCreate($data);
    }

    /**
     * Get single data
     *
     * @return UserModel
     */
    public function getNotificationToken(): UserModel
    {
        return $this->user_model->first();
    }
}
