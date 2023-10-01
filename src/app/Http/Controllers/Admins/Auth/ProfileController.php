<?php

namespace App\Http\Controllers\Admins\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdminResource;
use App\Http\Requests\Admins\UpdateProfileAdminRequest;
use App\Services\Admins\AdminService;
use Illuminate\Http\Response;

class ProfileController extends Controller
{
    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function me()
    {
        return responseOkAPI(
            Response::HTTP_OK,
            new AdminResource(auth('admin')->user())
        );
    }

    /**
     * Update profile user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateMe(UpdateProfileAdminRequest $request)
    {
        $updateMe = $this->adminService->updateMe($request->validated());
        return responseOkAPI(
            Response::HTTP_OK,
            new AdminResource($updateMe)
        );
    }
}
