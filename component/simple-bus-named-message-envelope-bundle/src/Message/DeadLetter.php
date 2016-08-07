<?php

namespace Hive\Component\Serializer\Message;

use SimpleBus\Message\Name\NamedMessage;

/**
 * Message that will be send to the serializer if a message name can't be matched
 */
class DeadLetter implements NamedMessage
{
    /**
     * {@inheritdoc}
     */
    public static function messageName()
    {
        return 'dead_letter_message';
    }
}
