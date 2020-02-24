<?php
declare(strict_types=1);

namespace App\Nova\Filters\Product;

use App;
use Henry\Domain\Category\Repositories\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

/**
 * Class Category
 * @package App\Nova\Filters\Product
 */
class Category extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'select-filter';

    /**
     * Apply the filter to the given query.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Request $request, $query, $value)
    {
       return $query->where('category_id', $value);
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request): array
    {
        $categoryRepository = App::make(CategoryRepositoryInterface::class);
        return $categoryRepository->all()->pluck('id', 'name')->toArray();
    }
}
