<?php

namespace Hive\Api\AppBundle\Controller;

use Hive\Api\AppBundle\Entity\ImportOrder;
use JMS\Serializer\DeserializationContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Swagger\Annotations as SWG;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;

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
     *     @SWG\Response(response="202", description="Order import accepted"),
     *     @SWG\Response(response="400", description="Invalid order data supplied"),
     * )
     *
     * @Route("", name="import_order")
     */
    public function importAction(Request $request)
    {
        // TODO: Make Serializer call DTO constructor to get validation working to enable this
//        $command = $this->get('serializer')->deserialize(
//            $request->getContent(),
//            ImportOrder::class,
//            'json'
//        );

        try {

            $data = json_decode($request->getContent(), true);
            $command = ImportOrder::fromArray($data);

            $this->get('command_bus')->handle($command);

        } catch (\InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage(), $e);
        } catch (\Exception $e) {
            throw new HttpException(Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage(), $e);
        }

        return new JsonResponse(null, Response::HTTP_ACCEPTED);
    }
}
