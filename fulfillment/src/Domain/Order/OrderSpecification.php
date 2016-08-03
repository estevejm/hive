<?php
namespace Hive\Fulfillment\Domain\Order;

interface OrderSpecification
{
    /**
     * @param Order $order
     * @return bool
     */
    public function isSatisfiedBy(Order $order) : bool;

    /**
     * @return string
     */
    public function description() : string;
}
