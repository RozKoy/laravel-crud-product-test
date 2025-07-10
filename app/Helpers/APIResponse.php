<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class APIResponse
{
    public static function GetAPIResponse(int $status, string $message, bool $success, mixed $data): JsonResponse
    {
        return response()->json(
            status: $status,
            data: [
                'message' => $message,
                'success' => $success,
                'data' => $data,
            ],
        );
    }
}
