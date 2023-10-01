<?php

use Symfony\Component\HttpFoundation\Response;

const SUCCESS_OK = 1;
const SUCCESS_FALSE = 0;
const ERROR_CODE_VALIDATE_FAIL = 'E0422';
const ERROR_CODE_AUTHENTICATE = 'E0401';
const ERROR_CODE_NOT_FOUND = 'E0404';
const ERROR_CODE_METHOD_NOT_ALLOWED = 'E0405';
const ERROR_CODE_FORBIDDEN = 'E0403';
const ERROR_CODE_INTERNAL_SERVER_ERROR = 'E0500';
const ERROR_CODE_TOKEN_EXPIRED = 'E1402';
const ERROR_CODE_TOKEN_EXPIRED_COULD_NOT_BE_REFRESHED = 'E1406';

function responseOkAPI($code, $data = null)
{
    if (!empty($data)) {
        if (is_array($data)) {
            $data = count($data) > 0 ? $data : null;
        } elseif (is_object($data)) {
            $data = $data->count() > 0 ? $data : null;
        } else {
            $data = $data ? $data : null;
        }
    }

    $output = [
        'success' => SUCCESS_OK,
        'data' => $data,
        'errors' => null
    ];
    return response()->json($output, $code);
}

function responseErrorAPI($code, $errorCode, $message, $data = null)
{
    $output = [
        'success' => SUCCESS_FALSE,
        'data' => $data,
        'errors' => [
            'error_code' => $errorCode,
            'error_message' => $message
        ]
    ];
    return response()->json($output, $code);
}
