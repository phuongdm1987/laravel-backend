<?php
declare(strict_types=1);

namespace App\Jobs;

use Henry\Domain\User\Repositories\UserRepositoryInterface;
use Henry\Domain\User\User;
use Illuminate\Auth\Events\Registered;

/**
 * Class RegisterApiUser
 * @package App\Jobs
 */
class RegisterApiUser extends RegisterUser
{

    /**
     * @param UserRepositoryInterface $userRepository
     * @return mixed
     */
    public function handle(UserRepositoryInterface $userRepository)
    {
        $user = parent::handle($userRepository);

        event(new Registered($user));

        $loginApiUserJob = new LoginApiUser(
            env('MIX_API_CLIENT_ID'),
            env('MIX_API_CLIENT_SECRET'),
            $this->email,
            $this->password
        );

        return dispatch_now($loginApiUserJob);
    }
}
