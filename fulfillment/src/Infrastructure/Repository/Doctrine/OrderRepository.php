<?php

namespace Hive\Fulfillment\Infrastructure\Repository\Doctrine;

use Doctrine\ORM\EntityRepository;
use Hive\Fulfillment\Domain\Order\Order;
use Hive\Fulfillment\Domain\Order\OrderId;
use Hive\Fulfillment\Domain\Order\OrderRepository as OrderRepositoryInterface;

class OrderRepository extends EntityRepository implements OrderRepositoryInterface
{

    /**
     * @return OrderId
     */
    public function nextIdentity(): OrderId
    {
        return new OrderId();
    }

    /**
     * @param Order $order
     */
    public function save(Order $order)
    {
        $this->getEntityManager()->persist($order);
        $this->getEntityManager()->flush($order);
    }
}
