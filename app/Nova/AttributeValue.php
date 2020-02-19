<?php
declare(strict_types=1);

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;

/**
 * Class AttributeValue
 * @package App\Nova
 * @method getUrl()
 * @method getValue()
 */
class AttributeValue extends Resource
{
    public static $with = ['attribute'];
    /**
     * The model the resource corresponds to.
     * @var string
     */
    public static $model = \Henry\Domain\AttributeValue\AttributeValue::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     * @var string
     */
    public static $title = 'value';

    /**
     * The columns that should be searched.
     * @var array
     */
    public static $search = [
        'id',
        'value',
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

            Text::make('Value')
                ->sortable()
                ->rules('required', 'max:255')
                ->creationRules('unique:attribute_values,value')
                ->updateRules('unique:attribute_values,value,{{resourceId}}'),

            Text::make('Url')
                ->nullable()
                ->displayUsing(function ($url) {
                    return '<a target="_blank" class="no-underline font-bold dim text-primary" href="' . $url . '">' . $url . '</a>';
                })
                ->asHtml()
                ->rules('url', 'nullable'),

            BelongsTo::make('Attribute')
                ->sortable()
                ->searchable()
                ->rules('required', 'exists:attributes,id'),
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

    /**
     * Get the search result subtitle for the resource.
     *
     * @return string|null
     */
    public function subtitle()
    {
        return 'Attribute: ' . $this->attribute->name;
    }
}
