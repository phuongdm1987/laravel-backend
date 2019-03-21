<?php
declare(strict_types=1);

namespace Henry\Infrastructure;

use League\Fractal\Manager;
use League\Fractal\Resource\ResourceAbstract;
use League\Fractal\TransformerAbstract;

/**
 * Class Transformer
 * @package Henry\Infrastructure
 */
class Transformer
{
    /**
     * @var ResourceFactory
     */
    private $resourceFactory;
    /**
     * @var Manager
     */
    private $manager;

    /**
     * Transformer constructor.
     * @param ResourceFactory $resourceFactory
     * @param Manager $manager
     */
    public function __construct(ResourceFactory $resourceFactory, Manager $manager)
    {
        $this->resourceFactory = $resourceFactory;
        $this->manager = $manager;
    }

    /**
     * @param $object
     * @param TransformerAbstract $transformer
     * @param string $resourceKey
     * @return array
     */
    public function transform($object, TransformerAbstract $transformer, string $resourceKey = ''): array
    {
        $resource = $this->generateResource($object, $transformer, $resourceKey);
        $this->manager->parseIncludes(request()->get('include', ''));

        return $this->manager->createData($resource)->toArray();
    }

    /**
     * @param $object
     * @param TransformerAbstract $transformer
     * @param string $resourceKey
     * @return ResourceAbstract
     */
    private function generateResource(
        $object,
        TransformerAbstract $transformer,
        string $resourceKey
    ): ResourceAbstract {
        $resource = $this->resourceFactory->make($object);
        $resource->setData($object);
        $resource->setTransformer($transformer);
        $resource->setResourceKey($resourceKey);

        return $resource;
    }
}
