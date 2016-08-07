<?php

namespace Hive\Component\Serializer\Envelope;

use Assert\Assertion;
use SimpleBus\Message\Name\NamedMessage;
use SimpleBus\Serialization\Envelope\EnvelopeFactory as EnvelopeFactoryInterface;

class EnvelopeFactory implements EnvelopeFactoryInterface
{
    public function wrapMessageInEnvelope($message)
    {
        Assertion::isInstanceOf($message, NamedMessage::class, 'This envelope only supports Named Messages');

        return Envelope::forNamedMessage($message->messageName(), $message);
    }

    public function envelopeClass()
    {
        return Envelope::class;
    }
}
