<?php

namespace Hive\Api\AppBundle\Entity;

use DateTime;
use Hive\Api\AppBundle\Messaging\Message;
use Assert\Assertion;
use Swagger\Annotations as SWG;

/**
 * @SWG\Definition(
 *     definition="ImportOrder"
 * )
 */
class ImportOrder implements Message
{
    /**
     * @var string
     *
     * @SWG\Property(property="external_id", example="EXT-001")
     */
    private $externalId;

    /**
     * @var string
     *
     * @SWG\Property(property="store_id", example="HIVE_US")
     */
    private $storeId;

    /**
     * @var string
     *
     * @SWG\Property(property="customer_id", example="1247274")
     */
    private $customerId;

    /**
     * @var DateTime
     *
     * @SWG\Property(property="placed_at", example="2016-08-18T00:06:07+0000")
     */
    private $placedAt;

    /**
     * @var array
     *
     * @SWG\Property(
     *     property="lines",
     *     @SWG\Items(ref="#/definitions/ImportOrderLine")
     * )
     *
     * @SWG\Definition(
     *     definition="ImportOrderLine",
     *     @SWG\Property(property="sku", type="string", example="SKU001"),
     *     @SWG\Property(property="line_number", type="integer", example=1)
     * )
     */
    private $lines;

    /**
     * @param string $externalId
     * @param string $storeId
     * @param string $customerId
     * @param DateTime $placedAt
     * @param array $lines
     */
    private function __construct(
        string $externalId,
        string $storeId,
        string $customerId,
        DateTime $placedAt,
        array $lines
    ) {
        Assertion::notEmpty($lines);
        Assertion::allKeyExists($lines, 'sku');
        Assertion::allKeyExists($lines, 'line_number');

        $this->externalId = $externalId;
        $this->storeId = $storeId;
        $this->customerId = $customerId;
        $this->placedAt = $placedAt;
        $this->lines = $lines;
    }

    /**
     * @param array $data
     * @return ImportOrder
     */
    public static function fromArray(array $data)
    {
        Assertion::keyExists($data, 'external_id');
        Assertion::keyExists($data, 'store_id');
        Assertion::keyExists($data, 'customer_id');
        Assertion::keyExists($data, 'placed_at');
        Assertion::keyExists($data, 'lines');

        return new self(
            $data['external_id'],
            $data['store_id'],
            $data['customer_id'],
            new DateTime($data['placed_at']),
            $data['lines']
        );
    }

    /**
     * @return string
     */
    public function externalId(): string
    {
        return $this->externalId;
    }

    /**
     * @return string
     */
    public function storeId(): string
    {
        return $this->storeId;
    }

    /**
     * @return string
     */
    public function customerId(): string
    {
        return $this->customerId;
    }

    /**
     * @return DateTime
     */
    public function placedAt(): DateTime
    {
        return $this->placedAt;
    }

    /**
     * @return array
     */
    public function lines(): array
    {
        return $this->lines;
    }

    /**
     * @inheritdoc
     */
    public static function messageName()
    {
        return 'import_order';
    }
}
