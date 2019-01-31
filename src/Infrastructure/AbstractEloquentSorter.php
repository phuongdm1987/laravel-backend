<?php
declare(strict_types=1);

namespace Henry\Infrastructure;

use Henry\Domain\ValueObjects\Order;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class AbstractEloquentSorter
 * @package Henry\Infrastructure
 */
abstract class AbstractEloquentSorter
{
    protected $fields = [];

    /**
     * @param Builder $queryBuilder
     * @param Order $order
     * @return Builder
     */
    public function order($queryBuilder, Order $order): Builder
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
