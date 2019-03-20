<?php
declare(strict_types=1);

namespace App\Http\View\Composers;


use App\Jobs\Category\GetCategoriesWithTreeFormat;
use Henry\Domain\Category\ValueObjects\Type;
use Illuminate\View\View;

/**
 * Class MenuComposer
 * @package App\Http\View\Composers
 */
class MenuComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view): void
    {
        $type = new Type();
        $menus = GetCategoriesWithTreeFormat::dispatchNow($type);

        $view->with(compact('menus'));
    }
}
