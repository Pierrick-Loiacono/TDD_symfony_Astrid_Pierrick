<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class TrajetController extends AbstractController
{
    /**
     * @Route("/trajet/new", name="trajet_new")
     */
    public function trajet_new()
    {
        return $this->render('trajet/index.html.twig', [
            'controller_name' => 'TrajetController',
        ]);
    }

}
