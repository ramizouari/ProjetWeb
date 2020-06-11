<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/main", name="main")
     */
    public function index()
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/accueil", name="accueil")
     */
public function accueil()
{
    return $this->render('base.html.twig');

}

    /**
     * @Route("/inscription",name="formulaire")
     */
public function formulaire()
{
return $this->render('formulaire.html.twig');

}

}
