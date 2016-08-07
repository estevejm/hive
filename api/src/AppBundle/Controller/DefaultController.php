<?php

namespace Hive\Api\AppBundle\Controller;

use Hive\Api\AppBundle\Entity\ImportOrder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $this->get('command_bus')->handle(new ImportOrder('H-001-API-' . uniqid(), 'HIVE_API', 'C001', new \DateTime(), [
            [
                'sku' => '123456',
                'number' => 1
            ],
            [
                'sku' => '789012',
                'number' => 3
            ]
        ]));

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);
    }
}
