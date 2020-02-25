<?php
declare(strict_types=1);

namespace App\Nova;

use Henry\Domain\Category\ValueObjects\Type;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;

/**
 * Class Category
 * @package App\Nova
 */
class Category extends Resource
{
    /**
     * The model the resource corresponds to.
     * @var string
     */
    public static $model = \Henry\Domain\Category\Category::class;

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
        'slug',
        'type',
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

            Select::make('Type')
                ->displayUsing(function ($type) {
                    return mb_strtoupper($type);
                })
                ->options(Type::getAll())
                ->sortable()
                ->rules('required', Rule::in(Type::getAll())),

            BelongsTo::make('Parent', 'parent', __CLASS__)
                ->sortable()
                ->searchable()
                ->nullable()
                ->rules('nullable', 'exists:categories,id')
                ->updateRules('not_in:{{resourceId}}'),

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255')
                ->creationRules('unique:categories,name')
                ->updateRules('unique:categories,name,{{resourceId}}'),

            Text::make('Slug')
                ->sortable()
                ->exceptOnForms(),

            HasMany::make('Products'),
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
        return [
            new \App\Nova\Filters\Category\Type(),
        ];
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
     * @return string
     */
    public function subtitle()
    {
        $subtitle = 'Type: ' . mb_strtoupper((string)$this->getType());

        if ($this->parent) {
            $subtitle .= ' | Parent: ' . $this->parent->name;
        }

        return $subtitle;
    }
}
