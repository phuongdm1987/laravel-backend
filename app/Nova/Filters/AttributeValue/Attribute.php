<?php
declare(strict_types=1);

namespace App\Nova\Filters\AttributeValue;

use App;
use Henry\Domain\Attribute\Repositories\AttributeRepositoryInterface;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

/**
 * Class Attribute
 * @package App\Nova\Filters\AttributeValue
 */
class Attribute extends Filter
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
        return $query->where('attribute_id', $value);
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request): array
    {
        $attributeRepository = App::make(AttributeRepositoryInterface::class);
        return $attributeRepository->all()->pluck( 'id', 'name')->toArray();
    }
}
