<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;

/**
 * Class SetLanguage
 * @package App\Http\Middleware
 */
class SetLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locale = session('locale', 'vi');
        app()->setLocale($locale);

        return $next($request);
    }
}
