<?php
declare(strict_types=1);

namespace App\Http\View\Composers;


use App\Jobs\Category\GetCategoriesWithTreeFormatJob;
use Henry\Domain\Category\ValueObjects\Type;
use Illuminate\View\View;

/**
 * Class CategoryComposer
 * @package App\Http\View\Composers
 */
class CategoryComposer
{

    /**
     * @param View $view
     */
    public function compose(View $view): void
    {
        $type = new Type(Type::TYPE_CATEGORY);
        $categories = GetCategoriesWithTreeFormatJob::dispatchNow($type);

        $view->with(compact('categories'));
    }
}
