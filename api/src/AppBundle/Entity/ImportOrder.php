<?php

namespace Hive\Api\AppBundle\Entity;

use DateTime;
use Hive\Api\AppBundle\Messaging\Message;
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
     * @SWG\Property(example="EXT-001")
     */
    private $externalId;

    /**
     * @var string
     *
     * @SWG\Property(example="HIVE_US")
     */
    private $storeId;

    /**
     * @var string
     *
     * @SWG\Property(example="1247274")
     */
    private $customerId;

    /**
     * @var DateTime
     *
     * @SWG\Property()
     */
    private $placedAt;

    /**
     * @var array
     *
     * @SWG\Property(
     *     @SWG\Items(ref="#/definitions/ImportOrderLine")
     * )
     *
     * @SWG\Definition(
     *     definition="ImportOrderLine",
     *     @SWG\Property(property="sku", type="string", example="SKU001"),
     *     @SWG\Property(property="lineNumber", type="integer", example=1)
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
    public function __construct(
        string $externalId,
        string $storeId,
        string $customerId,
        DateTime $placedAt,
        array $lines
    ) {
        // todo: validate line format
        $this->externalId = $externalId;
        $this->storeId = $storeId;
        $this->customerId = $customerId;
        $this->placedAt = $placedAt;
        $this->lines = $lines;
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
