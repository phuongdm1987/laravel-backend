<?php
declare(strict_types=1);

namespace Henry\Domain\Attribute;


use Henry\Domain\Attribute\ValueObjects\DataType;
use Henry\Domain\AttributeValue\AttributeValue;
use Henry\Domain\Category\Category;
use Henry\Domain\CustomizeSlugEngine;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Validation\ValidationException;

/**
 * Class Attribute
 * @property string name
 * @property int created_by
 * @property int id
 * @property string slug
 * @property string|null suffix
 * @property int data_type
 * @package Henry\Domain\Attribute
 */
class Attribute extends Model
{
    use CustomizeSlugEngine;

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
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @return string|null
     */
    public function getSuffix(): ?string
    {
        return $this->suffix;
    }

    /**
     * @return int
     */
    public function getCreatedById(): int
    {
        return $this->created_by;
    }

    /**
     * @return DataType
     * @throws ValidationException
     */
    public function getDataType(): DataType
    {
        return new DataType($this->data_type);
    }

    /**
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * @return HasMany
     */
    public function attributeValues(): HasMany
    {
        return $this->hasMany(AttributeValue::class);
    }
}
