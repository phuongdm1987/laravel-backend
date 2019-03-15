<?php
declare(strict_types=1);

namespace Henry\Infrastructure;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Support\Arrayable;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\ResourceAbstract;

/**
 * Class ResourceFactory
 * @package Henry\Infrastructure
 */
class ResourceFactory
{
    /**
     * @param $object
     * @return ResourceAbstract
     */
    public function make($object): ResourceAbstract
    {
        if ($object instanceof LengthAwarePaginator) {
            $resource = new Collection();
            $resource->setPaginator(new IlluminatePaginatorAdapter($object));
            return $resource;
        }

        if ($object instanceof Arrayable) {
            return new Collection();
        }

        return new Item();
    }
}
