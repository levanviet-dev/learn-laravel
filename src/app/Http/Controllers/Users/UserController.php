<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UpdateMeRequest;
use App\Services\Users\UserService;
use Illuminate\Http\Response;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getListUser()
    {
        $users = $this->userService->getListUser();

        return responseOkAPI(
            Response::HTTP_ACCEPTED,
            $users
        );
    }
}
