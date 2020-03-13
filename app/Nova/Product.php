<?php
declare(strict_types=1);

namespace App\Nova;

use App\Nova\Filters\Product\Category;
use App\Nova\Filters\Product\Timestamp;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;

/**
 * Class Product
 * @package App\Nova
 */
class Product extends Resource
{
    /**
     * The model the resource corresponds to.
     * @var string
     */
    public static $model = \Henry\Domain\Product\Product::class;

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
    ];

    /**
     * Get the fields displayed by the resource.
     * @param Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return array_merge([
            ID::make()->sortable(),

            Images::make('Images', 'images')
                ->conversionOnPreview('medium-size')
                ->conversionOnDetailView('thumb')
                ->conversionOnIndexView('thumb')
                ->conversionOnForm('thumb')
                ->fullSize()
                ->singleImageRules('dimensions:min_width=100')
                ->enableExistingMedia()
                ->withResponsiveImages(),

            BelongsTo::make('Category')
                ->sortable()
                ->searchable()
                ->rules('nullable', 'exists:categories,id'),

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255')
                ->creationRules('unique:products,name')
                ->updateRules('unique:products,name,{{resourceId}}'),

            Text::make('Slug')
                ->sortable()
                ->exceptOnForms(),

            Trix::make('Description')
                ->withFiles('image')
                ->stacked(),
        ],
            $this->attributeFields());
    }

    /**
     * Get the cards available for the request.
     * @param Request $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     * @param Request $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [
            new Category(),
            new Timestamp('created_at'),
            new Timestamp('updated_at'),
        ];
    }

    /**
     * Get the lenses available for the resource.
     * @param Request $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     * @param Request $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
