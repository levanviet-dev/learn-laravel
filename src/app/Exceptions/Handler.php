<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Facades\JWTAuth;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        $request->headers->set('Accept', 'application/json');
        if ($request->wantsJson()) {
            return $this->handleApiException($e);
        } else {
            return parent::render($request, $e);
        }
    }

    public function handleApiException($e)
    {
        if ($e instanceof AuthenticationException) {
            try {
                JWTAuth::parseToken()->authenticate();

                // Token is valid and not expired
                // Proceed with your logic here
            } catch (TokenExpiredException $e) {
                // Token has expired
                return responseErrorAPI(
                    Response::HTTP_UNAUTHORIZED,
                    ERROR_CODE_TOKEN_EXPIRED,
                    'トークンの有効期限が切れました。新しいトークンを申請してください。'
                );
            } catch (JWTException $e) {
                return responseErrorAPI(
                    Response::HTTP_UNAUTHORIZED,
                    ERROR_CODE_AUTHENTICATE,
                    'ログインしていません。もう一度ログインしてください。'
                );
            }
        }

        if ($e instanceof NotFoundHttpException) {
            return responseErrorAPI(
                Response::HTTP_NOT_FOUND,
                ERROR_CODE_NOT_FOUND,
                '要求されたリソースはシステムに存在しません。'
            );
        }

        if ($e instanceof MethodNotAllowedHttpException) {
            return responseErrorAPI(
                Response::HTTP_METHOD_NOT_ALLOWED,
                ERROR_CODE_METHOD_NOT_ALLOWED,
                'APIのアクセス方式が正しくありません。'
            );
        }

        if ($e instanceof AuthorizationException) {
            return responseErrorAPI(
                Response::HTTP_FORBIDDEN,
                ERROR_CODE_FORBIDDEN,
                'このリソースにアクセスする権限がありません。'
            );
        }

        Log::error($e->getMessage());
        return responseErrorAPI(
            Response::HTTP_INTERNAL_SERVER_ERROR,
            ERROR_CODE_INTERNAL_SERVER_ERROR,
            'エラーが発生しました。システムの管理者に連絡してください。'
        );
    }
}
