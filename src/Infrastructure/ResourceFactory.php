<?php
declare(strict_types=1);

namespace Henry\Infrastructure;

use Illuminate\Contracts\Support\Arrayable;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\ResourceInterface;

/**
 * Class ResourceFactory
 * @package Henry\Infrastructure
 */
class ResourceFactory
{
    /**
     * @param $object
     * @return ResourceInterface
     */
    public function make($object): ResourceInterface
    {
        if ($object instanceof Arrayable) {
            return new Collection();
        }

        return new Item();
    }
}
