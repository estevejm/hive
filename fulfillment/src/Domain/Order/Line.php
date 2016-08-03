<?php

namespace Hive\Fulfillment\Domain\Order;

class Line
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Order
     */
    private $order;

    /**
     * @var string
     */
    private $sku;

    /**
     * @var int
     */
    private $number;

    /**
     * @param Order $order
     * @param string $sku
     * @param int $number
     */
    public function __construct(Order $order, string $sku, int $number)
    {
        $this->order = $order;
        $this->sku = $sku;
        $this->number = $number;
    }

    /**
     * @return Order
     */
    public function order(): Order
    {
        return $this->order;
    }

    /**
     * @return string
     */
    public function sku(): string
    {
        return $this->sku;
    }

    /**
     * @return int
     */
    public function number(): int
    {
        return $this->number;
    }
}
