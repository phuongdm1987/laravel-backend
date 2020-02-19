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
 * @property int id
 * @property string name
 * @package Henry\Domain\Attribute
 */
class Attribute extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'is_filter'];

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
    public function isCanChange(): bool
    {
        $canChange = $this->pivot->can_change ?? false;

        return (bool)$canChange;
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
        return $this->belongsToMany(Category::class)->withPivot(['can_change']);
    }
}
