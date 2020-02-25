<?php
declare(strict_types=1);

namespace Henry\Domain\AttributeEntity;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Nova\Actions\Actionable;

/**
 * Class AttributeEntity
 * @package Henry\Domain\AttributeEntity
 */
class AttributeEntity extends \Rinvex\Attributes\Models\AttributeEntity
{
    use Actionable;

    /**
     * @return BelongsTo
     */
    public function attribute(): BelongsTo
    {
        return $this->belongsTo(config('rinvex.attributes.models.attribute'));
    }
}
