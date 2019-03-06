<?php
declare(strict_types=1);

namespace Henry\Domain\Attribute;

use Henry\Domain\AttributeValue\AttributeValue;
use Henry\Domain\Category\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Attribute
 * @package Henry\Domain\Attribute
 */
class Attribute extends Model
{
    public $timestamps = false;

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
     * @return bool
     */
    public function isFilter(): bool
    {
        return (bool)$this->is_filter;
    }

    /**
     * @return HasMany
     */
    public function attributeValues(): HasMany
    {
        return $this->hasMany(AttributeValue::class, 'attribute_id', 'id');
    }

    /**
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
}
