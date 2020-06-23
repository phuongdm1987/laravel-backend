<?php
declare(strict_types=1);

namespace Henry\Domain\Product;

use Henry\Domain\AttributeValue\AttributeValue;
use Henry\Domain\Category\Category;
use Henry\Domain\CustomizeSlugEngine;
use Henry\Domain\User\User;
use Henry\Domain\User\ValueObjects\Currency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Product
 * @property int created_by
 * @property int category_id
 * @property string slug
 * @property int amount
 * @property string description
 * @package Henry\Domain\Product
 */
class Product extends Model
{
    use CustomizeSlugEngine;

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
     * @return int
     */
    public function getCreatedById(): int
    {
        return $this->created_by;
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
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
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
    public function attributeValues(): BelongsToMany
    {
        return $this->belongsToMany(AttributeValue::class);
    }

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'product_users')
            ->withPivot(['amount'])->withTimestamps()->orderBy('pivot_updated_at')->orderBy('pivot_amount');
    }
}
