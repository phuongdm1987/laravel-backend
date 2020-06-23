<?php
declare(strict_types=1);

namespace Henry\Domain\AttributeValue;

use Henry\Domain\Product\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class AttributeValue
 * @property int id
 * @property string value
 * @package Henry\Domain\AttributeValue
 */
class AttributeValue extends Model
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
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
