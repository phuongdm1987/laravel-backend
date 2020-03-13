<?php
declare(strict_types=1);

namespace App\Nova\Filters\User;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

/**
 * Class ProfileId
 * @package App\Nova\Filters\User
 */
class ProfileId extends Filter
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
     * @param Request $request
     * @param Builder $query
     * @param mixed $value
     * @return Builder
     */
    public function apply(Request $request, $query, $value)
    {
        return $query->where('profile_id', $value);
    }

    /**
     * Get the filter's available options.
     *
     * @param Request $request
     * @return array
     */
    public function options(Request $request)
    {
        return array_flip(\Henry\Domain\User\ValueObjects\ProfileId::getAll());
    }
}
