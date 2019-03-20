<?php
declare(strict_types=1);

namespace App\Jobs\User;

use App\Http\Requests\RegisterRequest;
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
 * Class RegisterUser
 * @package App\Jobs
 */
class RegisterUser implements ShouldQueue
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
     * RegisterUser constructor.
     * @param string $name
     * @param string $email
     * @param string $password
     */
    public function __construct(string $name, string $email, string $password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @param RegisterRequest $request
     * @return RegisterUser
     */
    public static function fromRequest(RegisterRequest $request): self
    {
        return new static(
            $request->name(),
            $request->emailAddress(),
            $request->password()
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
            $user = $userRepository->findByEmailAddress($emailAddress);
        } catch (ModelNotFoundException $exception) {
            return true;
        }

        throw ValidationException::withMessages([
            'email' => [__('validation.unique', ['attribute' => 'email'])],
        ]);
    }
}
