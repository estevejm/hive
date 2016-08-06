<?php

namespace Hive\Fulfillment\Infrastructure\Messaging;

use SimpleBus\Serialization\Envelope\DefaultEnvelope;

class Envelope extends DefaultEnvelope
{
    /**
     * @param string $name
     * @param mixed $message
     * @return static
     */
    public static function forNamedMessage(string $name, $message)
    {
        return new self($name, $message, null);
    }
}
