<?php
declare(strict_types=1);

namespace App\Jobs\User;

use App\Http\Requests\RegisterRequest;
use Carbon\Carbon;
use Henry\Domain\User\Repositories\UserRepositoryInterface;
use Henry\Domain\User\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

/**
 * Class RegisterUserJob
 * @package App\Jobs
 */
class RegisterUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $password;
    /**
     * @var bool
     */
    private $activated;

    /**
     * RegisterUserJob constructor.
     * @param string $name
     * @param string $email
     * @param string $password
     * @param bool $activated
     */
    public function __construct(string $name, string $email, string $password, bool $activated = false)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->activated = $activated;
    }

    /**
     * @param RegisterRequest $request
     * @return RegisterUserJob
     */
    public static function fromRequest(RegisterRequest $request): self
    {
        return new static(
            $request->name(),
            $request->emailAddress(),
            $request->password(),
            $request->activated()
        );
    }

    /**
     * @param UserRepositoryInterface $userRepository
     * @return mixed
     */
    public function handle(UserRepositoryInterface $userRepository)
    {
        $this->assertEmailAddressIsUnique($this->email, $userRepository);

        $user = new User([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        if ($this->activated) {
            $user->email_verified_at = Carbon::now();
        }

        $user->save();

        return $user;
    }

    /**
     * @param string $emailAddress
     * @param UserRepositoryInterface $userRepository
     * @return bool
     */
    private function assertEmailAddressIsUnique(string $emailAddress, UserRepositoryInterface $userRepository): bool
    {
        try {
            $userRepository->findByEmailAddress($emailAddress);
        } catch (ModelNotFoundException $exception) {
            return true;
        }

        throw ValidationException::withMessages([
            'email' => [__('validation.unique', ['attribute' => 'email'])],
        ]);
    }
}
