<?php
declare(strict_types=1);

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;

/**
 * Class Attribute
 * @package App\Nova
 */
class Attribute extends Resource
{
    /**
     * The model the resource corresponds to.
     * @var string
     */
    public static $model = \Henry\Domain\Attribute\Attribute::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     * @var array
     */
    public static $search = [
        'id',
        'name',
    ];

    /**
     * Get the fields displayed by the resource.
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Select::make(__('Type'), 'type')
                ->options(
                    array_combine(
                        array_keys(\Rinvex\Attributes\Models\Attribute::typeMap()),
                        array_keys(array_change_key_case(\Rinvex\Attributes\Models\Attribute::typeMap(), CASE_UPPER))
                    )
                )
                ->rules('required')
            ,
            Text::make(__('Group'), 'group'),
            Text::make(__('Name'), 'name')
            ,
            Boolean::make(__('Is Required'), 'is_required')
                ->rules('required')
            ,
            Boolean::make(__('Is Collection'), 'is_collection')
                ->rules('required')
            ,
            Text::make(__('Default'), 'default')
            ,

            HasMany::make(__('Attribute Entities'), 'AttributeEntities')
                ->rules('required'),
        ];
    }

    /**
     * Get the cards available for the request.
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
