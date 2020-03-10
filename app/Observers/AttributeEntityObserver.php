<?php
declare(strict_types=1);

namespace App\Observers;

use Henry\Domain\AttributeEntity\AttributeEntity;

/**
 * Class AttributeEntityObserver
 * @package App\Observers
 */
class AttributeEntityObserver
{
    /**
     * @param AttributeEntity $attributeEntity
     */
    public function creating(AttributeEntity $attributeEntity)
    {
        $attributeEntity->created_by = auth()->id();
    }

    /**
     * Handle the attribute entity "created" event.
     *
     * @param AttributeEntity $attributeEntity
     * @return void
     */
    public function created(AttributeEntity $attributeEntity)
    {
        //
    }

    /**
     * Handle the attribute entity "updated" event.
     *
     * @param AttributeEntity $attributeEntity
     * @return void
     */
    public function updated(AttributeEntity $attributeEntity)
    {
        //
    }

    /**
     * Handle the attribute entity "deleted" event.
     *
     * @param AttributeEntity $attributeEntity
     * @return void
     */
    public function deleted(AttributeEntity $attributeEntity)
    {
        //
    }

    /**
     * Handle the attribute entity "restored" event.
     *
     * @param AttributeEntity $attributeEntity
     * @return void
     */
    public function restored(AttributeEntity $attributeEntity)
    {
        //
    }

    /**
     * Handle the attribute entity "force deleted" event.
     *
     * @param AttributeEntity $attributeEntity
     * @return void
     */
    public function forceDeleted(AttributeEntity $attributeEntity)
    {
        //
    }
}
