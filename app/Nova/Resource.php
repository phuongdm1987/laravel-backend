<?php
declare(strict_types=1);

namespace App\Nova;

use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource as NovaResource;

/**
 * Class Resource
 * @package App\Nova
 */
abstract class Resource extends NovaResource
{
    protected static $defaultSortField = 'sort_order';

    /**
     * Build an "index" query for the given resource.
     * @param  \Laravel\Nova\Http\Requests\NovaRequest $request
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query;
    }

    /**
     * Build a Scout search query for the given resource.
     * @param  \Laravel\Nova\Http\Requests\NovaRequest $request
     * @param  \Laravel\Scout\Builder $query
     * @return \Laravel\Scout\Builder
     */
    public static function scoutQuery(NovaRequest $request, $query)
    {
        return $query;
    }

    /**
     * Build a "detail" query for the given resource.
     * @param  \Laravel\Nova\Http\Requests\NovaRequest $request
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function detailQuery(NovaRequest $request, $query)
    {
        return parent::detailQuery($request, $query);
    }

    /**
     * Build a "relatable" query for the given resource.
     * This query determines which instances of the model may be attached to other resources.
     * @param  \Laravel\Nova\Http\Requests\NovaRequest $request
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function relatableQuery(NovaRequest $request, $query)
    {
        return parent::relatableQuery($request, $query);
    }

    /**
     * @return array
     */
    public function attributeFields(): array
    {
        $attributes = app('rinvex.attributes.attribute')::whereHas('entities', function ($query) {
            $query->where('entity_type', '=', static::$model);
        })
            ->orderBy(static::$defaultSortField, 'asc')
            ->get();
        if (!$attributes) {
            return [];
        }
        $fields = [];

        $fields[] = Heading::make('Attributes');
        foreach ($attributes as $attribute) {

            switch ($attribute->type) {
                case 'varchar':
                    $type = Text::class;
                    break;
                case 'text':
                    $type = Textarea::class;
                    break;
                case 'integer':
                    $type = Number::class;
                    break;
                default:
                    $type = Text::class;
                    break;
            }

            $fields[] = $type::make(__($attribute->name), $attribute->slug);
        }

        return $fields;
    }
}
