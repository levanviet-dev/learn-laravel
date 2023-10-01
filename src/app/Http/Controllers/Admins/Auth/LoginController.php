<?php

namespace App\Http\Controllers\Admins\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\LoginAdminRequest;
use App\Http\Requests\Users\LoginRequest;
use App\Http\Resources\AdminResource;
use App\Models\Admin;
use Illuminate\Http\Response;

class LoginController extends Controller
{
    /**
     * Login user
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginAdminRequest $request)
    {
        if (!$token = auth('admin')->attempt([
            'admin_code' => $request->admin_code,
            'password' => $request->password
        ])) {
            return responseErrorAPI(
                Response::HTTP_UNPROCESSABLE_ENTITY,
                Admin::ERR_LOGIN_FAILED,
                'パスワードの形式が正しくありません。文字、数字、特殊文字を含む 8 文字以上のパスワードである必要があります。'
            );
        }

        return $this->respondWithToken($token);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        $token = auth('admin')->refresh();
        auth('admin')->setToken($token)->user();
        return $this->respondWithToken($token);
    }

    /**
     * Response with token
     * @param $token
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        $response = [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('admin')->factory()->getTTL() * 60,
            'admin' => new AdminResource(auth('admin')->user())
        ];
        return responseOkAPI(
            Response::HTTP_OK,
            $response
        );
    }

    /**
     * Logout
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('admin')->logout();

        return responseOkAPI(Response::HTTP_OK);
    }
}
