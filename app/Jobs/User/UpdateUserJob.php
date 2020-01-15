<?php
declare(strict_types=1);

namespace App\Jobs\User;

use App\Http\Requests\User\UpdateUserRequest;
use Henry\Domain\User\Repositories\UserRepositoryInterface;
use Henry\Domain\User\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * Class UpdateUserJob
 * @package App\Jobs\User
 */
class UpdateUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var array
     */
    private $attributes;
    /**
     * @var User
     */
    private $user;

    /**
     * Create a new job instance.
     * @param array $attributes
     * @param User $user
     */
    public function __construct(array $attributes, User $user)
    {
        $this->attributes = $attributes;
        $this->user = $user;
    }

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function handle(UserRepositoryInterface $userRepository): void
    {
        $userRepository->update($this->attributes, $this->user);
    }

    /**
     * @param UpdateUserRequest $request
     * @param User $user
     * @return self
     */
    public static function fromRequest(UpdateUserRequest $request, User $user): self
    {
        return new static(
            [
                'name' => $request->name()
            ],
            $user
        );
    }
}
