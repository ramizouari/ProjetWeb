<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile/{id}", name="profile")
     */
    public function index($id)
    {
        $rep=$this->getDoctrine()->getRepository("App:User");

        $user=$rep->find($id);

        return $this->render('profile/index.html.twig',["user"=>$user]);
    }

}
