<?php

namespace Hive\Fulfillment\Domain\Customer;

use Ramsey\Uuid\Uuid;

class CustomerId
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
    public function uuid()
    {
        return $this->uuid;
    }
}
