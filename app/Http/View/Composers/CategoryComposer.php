<?php
declare(strict_types=1);

namespace App\Http\View\Composers;


use App\Jobs\GetCategoriesWithTreeFormat;
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
        $type = new Type();
        $type->setType(Type::TYPE_CATEGORY);
        $categories = GetCategoriesWithTreeFormat::dispatchNow($type);

        $view->with(compact('categories'));
    }
}
