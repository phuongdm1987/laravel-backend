<?php
declare(strict_types=1);

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;

/**
 * Class AttributeEntity
 * @package App\Nova
 */
class AttributeEntity extends Resource
{
    /**
     * The model the resource corresponds to.
     * @var string
     */
    public static $model = \Henry\Domain\AttributeEntity\AttributeEntity::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     * @var string
     */
    public static $title = 'entity_type';

    /**
     * The columns that should be searched.
     * @var array
     */
    public static $search = [
        'id',
        'entity_type',
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

            BelongsTo::make(__('Attribute'), 'Attribute')
                ->rules('required')
            ,
            Select::make(__('Entity Type'), 'entity_type')
                ->options(
                    array_combine(
                        app('rinvex.attributes.entities')->toArray(),
                        app('rinvex.attributes.entities')->toArray()
                    )
                )
                ->rules('required')
            ,
//            Number::make(__('Entity Id'), 'entity_id'), // not used???
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
