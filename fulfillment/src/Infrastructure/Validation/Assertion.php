<?php

namespace Hive\Fulfillment\Infrastructure\Validation;

use Assert\Assertion as BaseAssertion;

class Assertion extends BaseAssertion
{
    protected static $exceptionClass = AssertionFailedException::class;
}
