<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/default", name="default")
     */
    public function index()
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @Route("/page.{_format}", name="page")
     */
    public function page(Request $request)
    {
        switch ($request->getRequestFormat()) {
            case 'pdf':
                $template = 'default/page.pdf.twig';
                break;
            default:
                $template = 'default/page.pdf.twig';
        }

        return $this->render($template);
    }
}
