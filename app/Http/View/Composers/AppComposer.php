<?php
declare(strict_types=1);

namespace App\Http\View\Composers;


use Henry\Domain\Category\Repositories\CategoryRepositoryInterface;
use Henry\Domain\Category\Category;
use Illuminate\View\View;

/**
 * Class AppComposer
 * @package App\Http\View\Composers
 */
class AppComposer
{
    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepository;

    /**
     * AppComposer constructor.
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
        $categories = $this->categoryRepository->getAllCategoriesToTree();
        $view->with(compact('menus', 'categories'));
    }
}
