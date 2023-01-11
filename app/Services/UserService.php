<?php

namespace App\Services;

// Respositories
use \App\Repositories\UserRepository;

// Models
use \App\Models\UserModel;

class UserService
{
    private $user_repo;

    /**
     * Constructor
     */
    public function __construct(UserRepository $user_repo)
    {
        $this->user_repo = $user_repo;
    }

    /**
     * Create single data
     *
     * @return bool
     */
    public function createSingleData(array $data): bool
    {
        $result = $this->user_repo->createSingle($data);
        return !empty($result);
    }

    /**
     * Get single data
     *
     * @return string
     */
    public function getNotificationToken(): string
    {
        return $this->user_repo->getNotificationToken()->notification_token;
    }
}
