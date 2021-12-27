<?php

namespace App\Http\Controllers\Api\v1;

use Throwable;
use App\Models\User;
use App\Traits\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AuthController extends Controller
{
    use Response;
    public function register(RegisterRequest $request): JsonResponse
    {
        $validated = $request->validated();
        try {
            if ($request->expectsJson()) {
                $validated['role'] = $request->role ?? "buyer";
                $user = User::create($validated);

                if ($user) {
                    $token = $user->createToken($user->email . "_token")->plainTextToken;
                    return $this->successWithToken('Registration Successfully!', $user, 'user', $token, ResponseAlias::HTTP_OK);
                }
                return $this->error('Requested data is not valid!!', null, ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
            }
            return $this->error('Data is not valid!!', null, ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Throwable $e) {
            Log::info($e);
            return $this->error('Something went wrong!', null, ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
