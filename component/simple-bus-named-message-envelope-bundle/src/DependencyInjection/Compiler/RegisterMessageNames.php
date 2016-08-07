<?php

namespace Hive\Component\Serializer\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class RegisterMessageNames implements CompilerPassInterface
{
    const PARAMETER_ID = 'hive_serializer.message_map';
    const CLASS_ATTRIBUTE = 'deserializedInto';

    private $taggedBuses = [
        'asynchronous_command_handler'  => 'handles',
        'asynchronous_event_subscriber' => 'subscribes_to',
    ];

    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $messages = [];

        foreach ($this->taggedBuses as $tag => $nameAttribute) {
            foreach ($container->findTaggedServiceIds($tag) as $serviceId => $tags) {
                foreach ($tags as $tagAttributes) {
                    if (!isset($tagAttributes[self::CLASS_ATTRIBUTE])) {
                        throw new \InvalidArgumentException(
                            sprintf(
                                'The attribute "%s" of tag "%s" of service "%s" is mandatory',
                                self::CLASS_ATTRIBUTE,
                                $tag,
                                $serviceId
                            )
                        );
                    }

                    $messageName = $tagAttributes[$nameAttribute];

                    if (isset($messages[$messageName])) {
                        throw new \InvalidArgumentException(
                            sprintf(
                                'Message "%s" defined in service "%s" is duplicated',
                                $messageName,
                                $serviceId
                            )
                        );
                    }

                    $messages[$messageName] = $tagAttributes[self::CLASS_ATTRIBUTE];
                }
            }
        }

        $container->setParameter(self::PARAMETER_ID, $messages);
    }
}
