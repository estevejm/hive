<?php

namespace Hive\Fulfillment\Domain\Order;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Hive\Fulfillment\Domain\Customer\CustomerId;
use Hive\Fulfillment\Domain\Store\StoreId;
use Hive\Fulfillment\Infrastructure\Entity\AggregateRoot;

class Order extends AggregateRoot
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var OrderId
     */
    private $orderId;

    /**
     * @var string
     */
    private $externalId;

    /**
     * @var StoreId
     */
    private $storeId;

    /**
     * @var CustomerId
     */
    private $customerId;

    /**
     * @var Status
     */
    private $status;

    /**
     * @var DateTime
     */
    private $placedAt;

    /**
     * @var Line[]
     */
    private $lines;

    /**
     * @param OrderId $orderId
     * @param string $externalId
     * @param StoreId $storeId
     * @param CustomerId $customerId
     * @param DateTime $placedAt
     */
    public function __construct(
        OrderId $orderId,
        string $externalId,
        StoreId $storeId,
        CustomerId $customerId,
        DateTime $placedAt
    ) {
        $this->orderId = $orderId;
        $this->externalId = $externalId;
        $this->storeId = $storeId;
        $this->customerId = $customerId;
        $this->status = Status::initial();
        $this->placedAt = $placedAt;
        $this->lines = new ArrayCollection();

        $this->record(new OrderImported($this->orderId));
    }

    /**
     * @param Line $line
     */
    public function addLine(Line $line)
    {
        if (!$this->lines->contains($line)) {
            $this->lines->add($line);
        }
    }

    /**
     * @return Line[]
     */
    public function lines(): array
    {
        return $this->lines->toArray();
    }
}
