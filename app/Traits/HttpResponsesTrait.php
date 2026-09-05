<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait HttpResponsesTrait
{
    public function response(
        string $message,
        string|int $status,
        mixed $data = []
    ): JsonResponse {
        return response()->json([
            'success' => true,
            'message' => $message,
            'status' => $status,
            'data' => $data,
        ], $status);
    }
}
