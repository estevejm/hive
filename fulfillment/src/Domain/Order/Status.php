<?php

namespace Hive\Fulfillment\Domain\Order;

class Status
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $reason;

    /**
     * @param string $name
     * @param string $reason
     */
    public function __construct(string $name, string $reason)
    {
        $this->name = $name;
        $this->reason = $reason;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getReason(): string
    {
        return $this->reason;
    }

    /**
     * @return Status
     */
    public static function initial(): Status
    {
        return new self('NEW', 'Imported');
    }
}
