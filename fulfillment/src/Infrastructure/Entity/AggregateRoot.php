<?php

namespace Hive\Fulfillment\Infrastructure\Entity;

use SimpleBus\Message\Recorder\ContainsRecordedMessages;
use SimpleBus\Message\Recorder\PrivateMessageRecorderCapabilities;

abstract class AggregateRoot implements ContainsRecordedMessages
{
    use PrivateMessageRecorderCapabilities;
}
