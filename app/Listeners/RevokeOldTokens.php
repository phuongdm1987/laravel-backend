<?php
declare(strict_types=1);

namespace App\Listeners;

use DB;
use Illuminate\Contracts\Queue\ShouldQueue;
use Laravel\Passport\Events\AccessTokenCreated;

/**
 * Class RevokeOldTokens
 * @package App\Listeners
 */
class RevokeOldTokens implements ShouldQueue
{
    /**
     * Handle the event.
     * @param AccessTokenCreated $event
     * @return void
     */
    public function handle(AccessTokenCreated $event)
    {
        DB::table('oauth_access_tokens')
            ->where('id', '<>', $event->tokenId)
            ->where('user_id', $event->userId)
            ->where('client_id', $event->clientId)
            ->delete();

    }
}
