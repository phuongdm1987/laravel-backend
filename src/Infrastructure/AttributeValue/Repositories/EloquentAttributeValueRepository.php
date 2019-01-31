<?php
declare(strict_types=1);

namespace Henry\Infrastructure\AttributeValue\Repositories;

use Henry\Domain\AttributeValue\AttributeValue;
use Henry\Domain\AttributeValue\Filters\AttributeValueFilterInterface;
use Henry\Domain\AttributeValue\Repositories\AttributeValueRepositoryInterface;
use Henry\Domain\AttributeValue\Sorters\AttributeValueSorterInterface;
use Henry\Infrastructure\AbstractEloquentRepository;

/**
 * Class EloquentAttributeValueRepository
 * @package Henry\Infrastructure\AttributeValue\Repositories
 */
class EloquentAttributeValueRepository extends AbstractEloquentRepository implements AttributeValueRepositoryInterface
{
    /**
     * AbstractEloquentRepository constructor.
     * @param AttributeValue $model
     * @param AttributeValueFilterInterface $filter
     * @param AttributeValueSorterInterface $sorter
     */
    public function __construct(
        AttributeValue $model,
        AttributeValueFilterInterface $filter,
        AttributeValueSorterInterface $sorter
    ) {
        parent::__construct($model, $filter, $sorter);
    }
}
