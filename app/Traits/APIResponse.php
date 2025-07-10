<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Helpers\APIResponse as APIResponseHelper;

trait APIResponse
{
    public function Success(string $message = 'Success', mixed $data = []): JsonResponse
    {
        return APIResponseHelper::GetAPIResponse(Response::HTTP_OK, $message, true, $data);
    }

    public function Created(string $message = 'Created', mixed $data = []): JsonResponse
    {
        return APIResponseHelper::GetAPIResponse(Response::HTTP_CREATED, $message, true, $data);
    }

    public function BadRequest(mixed $errors = []): JsonResponse
    {
        return APIResponseHelper::GetAPIResponse(Response::HTTP_BAD_REQUEST, 'Bad Request', false, $errors);
    }

    public function Unauthorized(): JsonResponse
    {
        return APIResponseHelper::GetAPIResponse(Response::HTTP_UNAUTHORIZED, 'Unauthorized', false, null);
    }

    public function Forbidden(string $message = ''): JsonResponse
    {
        $message = $message === '' ? 'Forbidden' : "Forbidden: $message";

        return APIResponseHelper::GetAPIResponse(Response::HTTP_FORBIDDEN, $message, false, null);
    }

    public function NotFound(string $message = 'Not Found'): JsonResponse
    {
        return APIResponseHelper::GetAPIResponse(Response::HTTP_NOT_FOUND, $message, false, null);
    }
}
