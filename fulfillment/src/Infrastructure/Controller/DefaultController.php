<?php

namespace Hive\Fulfillment\Infrastructure\Controller;

use Hive\Fulfillment\Domain\Order\ImportOrder;
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
        $this->get('command_bus')->handle(new ImportOrder('H-001-MQ-' . uniqid(), 'HIVE_MQ', 'C001', new \DateTime(), [
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
