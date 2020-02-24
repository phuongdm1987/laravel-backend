<?php
declare(strict_types=1);

namespace App\Nova\Filters\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Laravel\Nova\Filters\DateFilter;

/**
 * Class Timestamp
 * @package App\Nova\Filters\Product
 */
class Timestamp extends DateFilter
{
    protected $column;

    /**
     * Timestamp constructor.
     * @param $column
     */
    public function __construct($column)
    {
        $this->column = $column;
    }

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
        $value = Carbon::parse($value);

        return $query->where($this->column, $value);
    }

    /**
     * Get the key for the filter.
     *
     * @return string
     */
    public function key(): string
    {
        return 'timestamp_'.$this->column;
    }

    /**
     * Get the displayable name of the filter.
     *
     * @return string
     */
    public function name(): string
    {
        return Str::title(str_replace('_', ' ', $this->column));
    }
}
