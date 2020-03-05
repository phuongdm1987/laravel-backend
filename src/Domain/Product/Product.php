<?php
declare(strict_types=1);

namespace Henry\Domain\Product;

use Cviebrock\EloquentSluggable\Sluggable;
use Henry\Domain\Category\Category;
use Henry\Domain\CustomizeSlugEngine;
use Henry\Domain\User\User;
use Henry\Domain\User\ValueObjects\Currency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Nova\Actions\Actionable;
use Laravel\Scout\Searchable;
use Rinvex\Attributes\Traits\Attributable;
use Rinvex\Support\Traits\HasTranslations;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

/**
 * Class Product
 * @package Henry\Domain\Product
 */
class Product extends Model implements HasMedia
{
    use Sluggable, CustomizeSlugEngine, Searchable, HasMediaTrait, Actionable;
    use Attributable, HasTranslations {
        Attributable::setAttribute insteadof HasTranslations;
    }

    protected $with = ['category'];

    protected $fillable = ['category_id', 'name', 'description'];

    /**
     * Get the index name for the model.
     * @return string
     */
    public function searchableAs(): string
    {
        return 'products_index';
    }

    /**
     * Get the route key for the model.
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * @return int
     */
    public function getCategoryId(): int
    {
        return $this->category_id;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @return Currency
     */
    public function getAmount(): Currency
    {
        return new Currency((float)$this->amount);
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Get the indexable data array for the model.
     * @return array
     */
    public function toSearchableArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
        ];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'product_users')
            ->withPivot(['amount'])->withTimestamps()->orderBy('pivot_updated_at')->orderBy('pivot_amount');
    }

    /**
     * @param Media|null $media
     * @throws InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(130)
            ->height(130);
        $this->addMediaConversion('medium-size')
            ->width(390)
            ->height(390);
    }

    public function registerMediaCollections()
    {
        $this->addMediaCollection('images');
    }
}
