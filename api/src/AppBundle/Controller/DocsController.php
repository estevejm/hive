<?php

namespace Hive\Api\AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Swagger\Annotations as SWG;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/docs")
 */
class DocsController extends Controller
{
    /**
     * @Route("/", name="swagger_ui")
     */
    public function swaggerUIAction()
    {
        return $this->render('@App/Docs/index.html.twig');
    }

    /**
     * @Route("/swagger.json", name="swagger_specification")
     */
    public function specificationAction()
    {
        $sourcePath = realpath(sprintf('%s/../src', $this->getParameter('kernel.root_dir')));

        $docs = \Swagger\scan($sourcePath);

        return new JsonResponse($docs, Response::HTTP_OK, ['content-type' => 'application/json']);
    }
}
