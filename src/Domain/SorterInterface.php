<?php
declare(strict_types=1);

namespace Henry\Domain;


use Henry\Domain\ValueObjects\Order;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Scout\Builder as ScoutBuilder;

/**
 * Interface SorterInterface
 * @package Henry\Domain
 */
interface SorterInterface
{
    /**
     * @param ScoutBuilder|Builder $queryBuilder
     * @param Order $order
     * @return ScoutBuilder|Builder
     */
    public function order($queryBuilder, Order $order);
}
