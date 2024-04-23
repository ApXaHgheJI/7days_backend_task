<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MyFormController extends AbstractController
{
    /**
     * @Route("/my/form", name="app_my_form")
     */
    public function index(): Response
    {
        return $this->render('my_form/index.html.twig', [
            'controller_name' => 'MyFormController',
        ]);
    }
}
