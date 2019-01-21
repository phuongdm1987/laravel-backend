<?php
declare(strict_types=1);

namespace Henry\Domain\Product;

use Cviebrock\EloquentSluggable\Sluggable;
use Henry\Domain\Category\Category;
use Henry\Domain\CustomizeSlugEngine;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Product
 * @package Henry\Domain\Product
 */
class Product extends Model
{
    use Sluggable, CustomizeSlugEngine;

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
