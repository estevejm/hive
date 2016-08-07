<?php

namespace Hive\Component\Serializer;

use Hive\Component\Serializer\DependencyInjection\Compiler\RegisterMessageNames;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class HiveSimpleBusNamedMessageEnvelopeBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(
            new RegisterMessageNames()
        );
    }
}
