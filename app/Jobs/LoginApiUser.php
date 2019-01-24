<?php
declare(strict_types=1);

namespace App\Jobs;

use App\Http\Requests\LoginApiRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class LoginApiUser
 * @package App\Jobs
 */
class LoginApiUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var int
     */
    private $clientId;
    /**
     * @var string
     */
    private $clientSecret;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $password;

    /**
     * Create a new job instance.
     * @param int $clientId
     * @param string $clientSecret
     * @param string $email
     * @param string $password
     */
    public function __construct(int $clientId, string $clientSecret, string $email, string $password)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @param LoginApiRequest $request
     * @return LoginApiUser
     */
    public static function fromRequest(LoginApiRequest $request): self
    {
        return new static(
            $request->clientId(),
            $request->clientSecret(),
            $request->emailAddress(),
            $request->password()
        );
    }

    /**
     * @return Response
     * @throws \Exception
     */
    public function handle(): Response
    {
        $data = [
            'grant_type' => 'password',
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'username' => $this->email,
            'password' => $this->password,
        ];

        $request = Request::create('/oauth/token', 'POST', $data);
        return app()->handle($request);
    }
}
