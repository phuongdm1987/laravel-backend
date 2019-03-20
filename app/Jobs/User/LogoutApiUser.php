<?php
declare(strict_types=1);

namespace App\Jobs\User;

use Henry\Domain\User\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

/**
 * Class LogoutApiUser
 * @package App\Jobs
 */
class LogoutApiUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var User
     */
    private $user;

    /**
     * LogoutApiUser constructor.
     * @param Authenticatable $user
     */
    public function __construct(Authenticatable $user)
    {
        //
        $this->user = $user;
    }

    /**
     * Execute the job.
     * @return void
     */
    public function handle(): void
    {
        $accessTokens = $this->user->tokens;

        DB::table('oauth_refresh_tokens')
            ->whereIn('access_token_id', $accessTokens->pluck('id')->toArray())
            ->delete();

        foreach ($accessTokens as $accessToken) {
            $accessToken->delete();
        }
    }
}
