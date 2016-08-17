<?php

namespace Hive\Api\AppBundle\Controller;

use Hive\Api\AppBundle\Entity\ImportOrder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Swagger\Annotations as SWG;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/orders")
 */
class OrderController extends Controller
{
    /**
     * @SWG\Post(
     *     path="/orders",
     *     summary="Import order",
     *     description="Imports a order that has been placed elsewhere",
     *     tags={"Orders"},
     *     @SWG\Parameter(
     *         name="order",
     *         in="body",
     *         description="Order to be imported",
     *         required=true,
     *         @SWG\Schema(ref="#/definitions/ImportOrder"),
     *     ),
     *     @SWG\Response(response="202", description="Order import accepted")
     * )
     *
     * @Route("/", name="import_order")
     */
    public function importAction(Request $request)
    {
        $command = new ImportOrder('H-001-API-' . uniqid(), 'HIVE_API', 'C001', new \DateTime(), [
            [
                'sku' => '123456',
                'number' => 1
            ],
            [
                'sku' => '789012',
                'number' => 3
            ]
        ]);

        $this->get('command_bus')->handle($command);

        return new JsonResponse(['status' => 'success'], Response::HTTP_ACCEPTED);
    }
}
