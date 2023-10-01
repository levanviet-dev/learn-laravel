<?php

namespace App\Http\Controllers\Users\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Requests\Users\UpdateMeRequest;
use App\Services\Users\UserService;
use Illuminate\Http\Response;

class ProfileController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function me()
    {
        return responseOkAPI(
            Response::HTTP_OK,
            new UserResource(auth('user')->user())
        );
    }

    /**
     * Update profile user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateMe(UpdateMeRequest $request)
    {
        $updateMe = $this->userService->updateMe($request->validated());
        return responseOkAPI(
            Response::HTTP_OK,
            new UserResource($updateMe)
        );
    }
}
