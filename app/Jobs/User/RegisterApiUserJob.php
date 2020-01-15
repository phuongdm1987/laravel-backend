<?php
declare(strict_types=1);

namespace App\Jobs\User;

use Henry\Domain\User\Repositories\UserRepositoryInterface;
use Illuminate\Auth\Events\Registered;

/**
 * Class RegisterApiUserJob
 * @package App\Jobs
 */
class RegisterApiUserJob extends RegisterUserJob
{

    /**
     * @param UserRepositoryInterface $userRepository
     * @return mixed
     */
    public function handle(UserRepositoryInterface $userRepository)
    {
        $user = parent::handle($userRepository);

        event(new Registered($user));

        $loginApiUserJob = new LoginApiUserJob(
            (int)env('MIX_API_CLIENT_ID'),
            env('MIX_API_CLIENT_SECRET'),
            $this->email,
            $this->password
        );

        return dispatch_now($loginApiUserJob);
    }
}
