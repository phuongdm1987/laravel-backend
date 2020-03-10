<?php
declare(strict_types=1);

namespace Henry\Domain\AttributeEntity;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Nova\Actions\Actionable;

/**
 * Class AttributeEntity
 * @property int created_by
 * @package Henry\Domain\AttributeEntity
 */
class AttributeEntity extends \Rinvex\Attributes\Models\AttributeEntity
{
    use Actionable;

    /**
     * @return int
     */
    public function getCreatedById(): int
    {
        return $this->created_by;
    }

    /**
     * @return BelongsTo
     */
    public function attribute(): BelongsTo
    {
        return $this->belongsTo(config('rinvex.attributes.models.attribute'));
    }
}
