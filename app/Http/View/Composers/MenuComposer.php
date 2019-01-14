<?php
declare(strict_types=1);

namespace App\Http\View\Composers;


use Henry\Domain\Category\Repositories\CategoryRepositoryInterface;
use Henry\Domain\Category\Category;
use Illuminate\View\View;

/**
 * Class MenuComposer
 * @package App\Http\View\Composers
 */
class MenuComposer
{
    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepository;

    /**
     * MenuComposer constructor.
     * @param \Henry\Domain\Category\Repositories\CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {

        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param View $view
     */
    public function compose(View $view): void
    {
//        $this->categoryRepository->rebuildTree();
        $menus = $this->categoryRepository->getAllMenusToTree();
        $view->with(compact('menus'));
    }
}
