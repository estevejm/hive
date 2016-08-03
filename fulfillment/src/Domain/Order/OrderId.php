<?php

namespace Hive\Fulfillment\Domain\Order;

use Ramsey\Uuid\Uuid;

class OrderId
{
    /**
     * @var string
     */
    private $uuid;

    /**
     * @param string $uuid
     */
    public function __construct(string $uuid = null)
    {
        $this->uuid = $uuid ?: Uuid::uuid4()->toString();
    }

    /**
     * @return string
     */
    public function uuid(): string
    {
        return $this->uuid;
    }
}
