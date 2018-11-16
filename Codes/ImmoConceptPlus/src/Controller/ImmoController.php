<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ImmoController extends AbstractController
{
    /**
     * @Route("/", name="immo")
     */
    public function index()
    {
        return $this->render('immo/index.html.twig', [
            'controller_name' => 'ImmoController',
        ]);
    }

    /**
     * @Route("/achat",name="achat")
     */
    public function acheter(){
        return $this->render('immo/acheter.html.twig');
    }

    /**
     * @Route("/show",name="show")
     */
    public function show(){
        return $this->render('immo/seul.html.twing');
    }
}
