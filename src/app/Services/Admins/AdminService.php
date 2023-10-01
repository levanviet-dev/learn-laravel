<?php


namespace App\Services\Admins;

use App\Repositories\AdminRepository;
use App\Services\BaseService;

class AdminService extends BaseService
{
    protected $adminRepository;

    public function __construct(
        AdminRepository       $adminRepository,
    )
    {
        $this->adminRepository = $adminRepository;
    }

    /**
     * Update profile admin.
     *
     * @return \App\Repositories\BaseRepository
     */
    public function updateMe($params)
    {
        $adminId = auth('admin')->user()->id;
        return $this->adminRepository->update($params, $adminId);
    }
}
