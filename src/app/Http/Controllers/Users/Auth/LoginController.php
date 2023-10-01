<?php

namespace App\Http\Controllers\Users\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    /**
     * Login user
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        if (!$token = auth('user')
            ->attempt(['user_code' => $request->user_code, 'password' => $request->password])) {
            return responseErrorAPI(
                Response::HTTP_UNPROCESSABLE_ENTITY,
                User::ERR_LOGIN_FAILED,
                'ユーザーIDまたはパスワードが正しくありません。'
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
        try {
            $token = JWTAuth::parseToken();

            if (!$token) {
                // Token not present
                return responseErrorAPI(
                    Response::HTTP_UNAUTHORIZED,
                    ERROR_CODE_AUTHENTICATE,
                    'ログインしていません。もう一度ログインしてください。'
                );
            }

            $token = auth('user')->refresh();
            auth('user')->setToken($token)->user();
            return $this->respondWithToken($token);
            // Token is valid and not expired
            // Proceed with your logic here
        } catch (TokenExpiredException $e) {
            return responseErrorAPI(
                Response::HTTP_UNAUTHORIZED,
                ERROR_CODE_TOKEN_EXPIRED_COULD_NOT_BE_REFRESHED,
                'このリソースにアクセスする権限がありません。'
            );
        } catch (JWTException $e) {
            return responseErrorAPI(
                Response::HTTP_UNAUTHORIZED,
                ERROR_CODE_AUTHENTICATE,
                'ログインしていません。もう一度ログインしてください。'
            );
        }
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
            'expires_in' => auth('user')->factory()->getTTL() * 60,
            'user' => new UserResource(auth('user')->user())
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
        auth('user')->logout();

        return responseOkAPI(Response::HTTP_OK);
    }
}
