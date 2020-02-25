<?php
declare(strict_types=1);

namespace Henry\Domain\Attribute;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Nova\Actions\Actionable;

/**
 * Class Attribute
 * @property int id
 * @property string name
 * @package Henry\Domain\Attribute
 */
class Attribute extends \Rinvex\Attributes\Models\Attribute
{
    use Actionable;

    /**
     * @return HasMany
     */
    public function attributeEntities(): HasMany
    {
        return parent::entities();
    }
}
