<?php
declare(strict_types=1);

namespace Henry\Domain\Attribute;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Nova\Actions\Actionable;

/**
 * Class Attribute
 * @property int id
 * @property string name
 * @property int created_by
 * @package Henry\Domain\Attribute
 */
class Attribute extends \Rinvex\Attributes\Models\Attribute
{
    use Actionable;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getCreatedById(): int
    {
        return $this->created_by;
    }

    /**
     * @return HasMany
     */
    public function attributeEntities(): HasMany
    {
        return parent::entities();
    }
}
