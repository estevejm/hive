<?php

namespace Hive\Fulfillment\Domain\Order;

interface OrderRepository
{
    /**
     * @return OrderId
     */
    public function nextIdentity(): OrderId;

    /**
     * @param Order $order
     */
    public function save(Order $order);
}
