<?php

namespace Hive\Fulfillment\Domain\Order;

class OrderLinesHaveUniqueNumbers implements OrderSpecification
{
    /**
     * {@inheritdoc}
     */
    public function isSatisfiedBy(Order $order): bool
    {
        $numbers = [];

        foreach ($order->lines() as $line) {
            if (isset($numbers[$line->number()])) {
                return false;
            }
            $numbers[$line->number()] = true;
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function description(): string
    {
        return 'Line numbers of order must be unique';
    }
}
