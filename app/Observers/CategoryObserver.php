<?php
declare(strict_types=1);

namespace App\Observers;

use Henry\Domain\Category\Category;

/**
 * Class CategoryObserver
 * @package App\Observers
 */
class CategoryObserver
{
    /**
     * @param Category $category
     */
    public function creating(Category $category)
    {
        $category->created_by = auth()->id();
    }

    /**
     * Handle the category "created" event.
     *
     * @param Category $category
     * @return void
     */
    public function created(Category $category)
    {
        //
    }

    /**
     * Handle the category "updated" event.
     *
     * @param Category $category
     * @return void
     */
    public function updated(Category $category)
    {
        //
    }

    /**
     * Handle the category "deleted" event.
     *
     * @param Category $category
     * @return void
     */
    public function deleted(Category $category)
    {
        //
    }

    /**
     * Handle the category "restored" event.
     *
     * @param Category $category
     * @return void
     */
    public function restored(Category $category)
    {
        //
    }

    /**
     * Handle the category "force deleted" event.
     *
     * @param Category $category
     * @return void
     */
    public function forceDeleted(Category $category)
    {
        //
    }
}
