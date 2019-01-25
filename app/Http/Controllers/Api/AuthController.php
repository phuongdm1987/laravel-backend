<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\LoginApiRequest;
use App\Jobs\LoginApiUser;
use App\Jobs\LogoutApiUser;
use Henry\Application\Http\JsonResponseTrait;
use App\Http\Controllers\Controller;

/**
 * Class AuthController
 * @package App\Http\Controllers\Api
 */
class AuthController extends Controller
{
    use JsonResponseTrait;

    /**
     * @param LoginApiRequest $request
     * @return mixed
     */
    public function login(LoginApiRequest $request)
    {
        $response = $this->dispatchNow(LoginApiUser::fromRequest(app(LoginApiRequest::class)));
        $data = json_decode($response->getContent());

        return $this->success([
            'status' => 200,
            'token' => $data->access_token,
            'user' => auth()->user()
        ]);
    }

    /**
     * @return mixed
     */
    public function logout()
    {
        $job = new LogoutApiUser(auth()->user());
        $this->dispatchNow($job);

        return $this->success(['status' => 200]);
    }
}
