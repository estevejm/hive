<?php

namespace Hive\Fulfillment\Domain\Order;

use Hive\Fulfillment\Infrastructure\Messaging\Message;

class OrderImported implements Message
{
    /**
     * @var OrderId
     */
    private $orderId;

    /**
     * @param OrderId $orderId
     */
    public function __construct(OrderId $orderId)
    {
        $this->orderId = $orderId;
    }

    /**
     * @return OrderId
     */
    public function orderId(): OrderId
    {
        return $this->orderId;
    }

    /**
     * {@inheritdoc}
     */
    public static function messageName()
    {
        return 'order_imported';
    }
}
