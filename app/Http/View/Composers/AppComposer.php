<?php
declare(strict_types=1);

namespace App\Http\View\Composers;


use App\Entities\Category;
use Illuminate\View\View;

/**
 * Class AppComposer
 * @package App\Http\View\Composers
 */
class AppComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view): void
    {
//        Category::rebuildTree([], false);
        $nodes = Category::get()->toTree();
        $view->with('nodes', $nodes);
    }
}
