<?php

namespace Hive\Fulfillment\Application\Order;

use Hive\Fulfillment\Domain\Customer\CustomerId;
use Hive\Fulfillment\Domain\Order\ImportOrder;
use Hive\Fulfillment\Domain\Order\Line;
use Hive\Fulfillment\Domain\Order\Order;
use Hive\Fulfillment\Domain\Order\OrderHaveLines;
use Hive\Fulfillment\Domain\Order\OrderLinesHaveUniqueNumbers;
use Hive\Fulfillment\Domain\Order\OrderRepository;
use Hive\Fulfillment\Domain\Order\OrderSpecification;
use Hive\Fulfillment\Domain\Store\StoreId;
use Hive\Fulfillment\Infrastructure\Validation\Assertion;

class ImportOrderHandler
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;

    /**
     * @param OrderRepository $orderRepository
     */
    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * @param ImportOrder $command
     */
    public function handle(ImportOrder $command)
    {
        $order = new Order(
            $this->orderRepository->nextIdentity(),
            $command->externalId(),
            new StoreId($command->storeId()),
            new CustomerId($command->customerId()),
            $command->placedAt()
        );

        foreach ($command->lines() as $line) {
            $order->addLine(new Line($order, $line['sku'], $line['number']));
        }

        // todo: check invariants inside entity so it is always consistent!
        $this->checkInvariants($order);

        $this->orderRepository->save($order);
    }

    /**
     * @param Order $order
     */
    private function checkInvariants(Order $order)
    {
        /** @var OrderSpecification[] $specifications */
        $specifications = [
            new OrderHaveLines(),
            new OrderLinesHaveUniqueNumbers(),
        ];

        foreach ($specifications as $specification) {
            Assertion::true($specification->isSatisfiedBy($order), $specification->description());
        }
    }
}
