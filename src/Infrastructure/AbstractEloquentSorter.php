<?php
declare(strict_types=1);

namespace Henry\Infrastructure;


use Henry\Domain\ValueObjects\Order;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Scout\Builder as ScoutBuilder;

/**
 * Class AbstractEloquentSorter
 * @package Henry\Infrastructure
 */
abstract class AbstractEloquentSorter
{
    protected $fields = [];

    /**
     * @param ScoutBuilder|Builder $queryBuilder
     * @param Order $order
     * @return ScoutBuilder|Builder
     */
    public function order($queryBuilder, Order $order)
    {
        if ($this->assertDontAllowField($order)) {
            return $queryBuilder;
        }

        $queryBuilder = $queryBuilder->orderBy($order->getField(), $order->getDirection());

        return $queryBuilder;
    }

    /**
     * @param Order $order
     * @return bool
     */
    private function assertDontAllowField(Order $order): bool
    {
        return !\in_array($order->getField(), $this->fields, true);
    }
}
