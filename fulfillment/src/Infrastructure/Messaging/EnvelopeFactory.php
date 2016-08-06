<?php

namespace Hive\Fulfillment\Infrastructure\Messaging;

use Hive\Fulfillment\Infrastructure\Validation\Assertion;
use SimpleBus\Serialization\Envelope\EnvelopeFactory as EnvelopeFactoryInterface;

class EnvelopeFactory implements EnvelopeFactoryInterface
{
    public function wrapMessageInEnvelope($message)
    {
        Assertion::isInstanceOf($message, Message::class, 'This envelope only supports Named Messages');

        return Envelope::forNamedMessage($message->messageName(), $message);
    }

    public function envelopeClass()
    {
        return Envelope::class;
    }
}
