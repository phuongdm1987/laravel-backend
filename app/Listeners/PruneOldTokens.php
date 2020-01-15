<?php
declare(strict_types=1);

namespace App\Listeners;

use DB;
use Illuminate\Contracts\Queue\ShouldQueue;
use Laravel\Passport\Events\RefreshTokenCreated;

/**
 * Class PruneOldTokens
 * @package App\Listeners
 */
class PruneOldTokens implements ShouldQueue
{
    /**
     * Handle the event.
     * @param RefreshTokenCreated $event
     * @return void
     */
    public function handle(RefreshTokenCreated $event): void
    {
        DB::table('oauth_refresh_tokens')
            ->where('id', '<>', $event->refreshTokenId)
            ->where('access_token_id', '<>', $event->accessTokenId)
            ->delete();
    }
}
