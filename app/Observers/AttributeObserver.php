<?php
declare(strict_types=1);

namespace App\Observers;

use Henry\Domain\Attribute\Attribute;

/**
 * Class AttributeObserver
 * @package App\Observers
 */
class AttributeObserver
{
    /**
     * @param Attribute $attribute
     */
    public function creating(Attribute $attribute)
    {
        $attribute->created_by = auth()->id();
    }

    /**
     * Handle the attribute "created" event.
     *
     * @param Attribute $attribute
     * @return void
     */
    public function created(Attribute $attribute)
    {
        //
    }

    /**
     * Handle the attribute "updated" event.
     *
     * @param Attribute $attribute
     * @return void
     */
    public function updated(Attribute $attribute)
    {
        //
    }

    /**
     * Handle the attribute "deleted" event.
     *
     * @param Attribute $attribute
     * @return void
     */
    public function deleted(Attribute $attribute)
    {
        //
    }

    /**
     * Handle the attribute "restored" event.
     *
     * @param Attribute $attribute
     * @return void
     */
    public function restored(Attribute $attribute)
    {
        //
    }

    /**
     * Handle the attribute "force deleted" event.
     *
     * @param Attribute $attribute
     * @return void
     */
    public function forceDeleted(Attribute $attribute)
    {
        //
    }
}
