<?php
declare(strict_types=1);

namespace Henry\Domain\AttributeValue;

use Henry\Domain\Attribute\Attribute;
use Henry\Domain\Product\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class AttributeValue
 * @property int attribute_id
 * @property int id
 * @property string value
 * @property string url
 * @package Henry\Domain\AttributeValue
 */
class AttributeValue extends Model
{
    public $timestamps = false;
    protected $fillable = ['attribute_id', 'value', 'url'];

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
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return (string)$this->url;
    }

    /**
     * @return int
     */
    public function getAttributeId(): int
    {
        return $this->attribute_id;
    }

    /**
     * @return BelongsTo
     */
    public function attribute(): BelongsTo
    {
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }

    /**
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
