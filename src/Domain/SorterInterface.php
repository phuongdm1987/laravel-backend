<?php
declare(strict_types=1);

namespace Henry\Domain;


use Henry\Domain\ValueObjects\Order;
use Illuminate\Database\Eloquent\Builder;

/**
 * Interface SorterInterface
 * @package Henry\Domain
 */
interface SorterInterface
{
    /**
     * @param Builder $queryBuilder
     * @param Order $order
     * @return Builder
     */
    public function order($queryBuilder, Order $order): Builder;
}
