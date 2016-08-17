<?php

namespace Hive\Api\AppBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Swagger\Annotations as SWG;

/**
 * @SWG\Swagger(
 *     basePath="/",
 *     schemes={"http"},
 *     produces={"application/json"},
 *     consumes={"application/json"},
 *     @SWG\Info(title="Hive API", version="0.1")
 * )
 */
class AppBundle extends Bundle
{
}
