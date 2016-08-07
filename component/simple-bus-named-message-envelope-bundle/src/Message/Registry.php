<?php

namespace Hive\Component\Serializer\Message;

class Registry
{
    /**
     * @var array
     */
    private $map;

    /**
     * @param array $map
     */
    public function __construct(array $map)
    {
        $this->map = $map;
    }

    /**
     * @param string $name
     * @return string
     */
    public function getMessageClass($name)
    {
        if (!$this->isRegistered($name)) {
            return DeadLetter::class;
        }

        return $this->map[$name];
    }

    /**
     * @param string $name
     * @return bool
     */
    public function isRegistered($name)
    {
        return isset($this->map[$name]);
    }
}
