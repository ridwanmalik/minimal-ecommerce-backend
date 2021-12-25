<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

trait Response
{
    protected function success(string $message, $data = [], string $data_key, int $status_code): JsonResponse
    {
        return response()->json([
            'isSuccess' => true,
            'message' => $message,
            'data' => [$data_key => $data]
        ], $status_code);
    }

    protected function successWithToken(string $message, $data = [], string $data_key, string $token, int $status_code): JsonResponse
    {
        return response()->json([
            'isSuccess' => true,
            'message' => $message,
            'data' => [$data_key => $data],
            'token' => $token,
        ], $status_code);
    }

    protected function successWithData($data = [], string $data_key): JsonResponse
    {
        return response()->json([
            'isSuccess' => true,
            'data' => [$data_key => $data]
        ], ResponseAlias::HTTP_OK);
    }

    protected function successWithSingleData(Object $data): JsonResponse
    {
        return response()->json([
            'isSuccess' => true,
            'data' => $data
        ], ResponseAlias::HTTP_OK);
    }

    protected function error(string $message, $data = [], int $status_code): JsonResponse
    {
        return response()->json([
            'isSuccess' => false,
            'error' => $message,
            'data' => $data
        ], $status_code);
    }

    protected function authenticateWithToken(string $token, object $user): JsonResponse
    {
        return response()->json([
            'isSuccess' => true,
            'message' => 'Authentication successful',
            'data' => ['user' => $user],
            'headers' => [
                "Content-Type" => "application/json",
                "token" => $token
            ],
        ], ResponseAlias::HTTP_OK);
    }
}
