<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\LoginApiRequest;
use App\Http\Requests\RegisterRequest;
use App\Jobs\User\LoginApiUser;
use App\Jobs\User\LogoutApiUser;
use App\Jobs\User\RegisterApiUser;
use Illuminate\Http\JsonResponse;

/**
 * Class AuthController
 * @package App\Http\Controllers\Api
 */
class AuthController extends ApiController
{
    /**
     * @param LoginApiRequest $request
     * @return JsonResponse
     */
    public function login(LoginApiRequest $request): JsonResponse
    {
        $response = $this->dispatchNow(LoginApiUser::fromRequest($request));

        if (isset($response->error)) {
            return $this->error([$response->error => $response->message], 401);
        }

        return $this->success([
            'status' => 200,
            'token' => $response->access_token,
            'user' => auth()->user()
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        $job = new LogoutApiUser(auth()->user());
        $this->dispatchNow($job);

        return $this->success(['status' => 200]);
    }

    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $response = $this->dispatchNow(RegisterApiUser::fromRequest($request));

        if (isset($response->error)) {
            return $this->error([$response->error => $response->message], 401);
        }

        return $this->success([
            'status' => 200,
            'token' => $response->access_token,
            'user' => auth()->user()
        ]);
    }
}
