<?php

namespace Hive\Fulfillment\Domain\Order;

class OrderHaveLines implements OrderSpecification
{
    /**
     * {@inheritdoc}
     */
    public function isSatisfiedBy(Order $order): bool
    {
        return !empty($order->lines());
    }

    /**
     * {@inheritdoc}
     */
    public function description(): string
    {
        return 'Order must have at least one line';
    }
}
