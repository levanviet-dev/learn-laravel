<?php


namespace App\Services\Users;

use App\Repositories\UserRepository;
use App\Services\BaseService;

class UserService extends BaseService
{
    protected $userRepository;

    public function __construct(
        UserRepository       $userRepository,
    )
    {
        $this->userRepository = $userRepository;
    }

    public function getListUser()
    {
        return $this->userRepository->all();
    }

    /**
     * Update profile user.
     *
     * @return \App\Repositories\BaseRepository
     */
    public function updateMe($params)
    {
        $userId = auth('user')->user()->id;
        return $this->userRepository->update($params, $userId);
    }
}
