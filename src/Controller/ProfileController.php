<?php

namespace App\Controller;

use Http\Client\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     */
    public function index(Request $request)
    {
        $id=$request->query->get('id');
        $rep=$this->getDoctrine()->getRepository("App:User");
        $user=$rep->find($id);

        return $this->render('profile/index.html.twig',["user"=>$user]);
    }
    /**
     * @Route("/listej", name="liste_journal")
     */

    public function lister_j($id)
    {
       /* try {
            $rep=$this->getDoctrine()->getRepository("App:Publication");
            $rep2=$this->getDoctrine()->getRepository("App:User");
            $pubs=$rep->findBy(array("proprietaire"=>$rep2->find($id)),array("proprietaire"=>"ASC"));

        }*/
        //catch (Exception $e ){

            $pubs=null ;
    //}

        return$this->render("profile/journale.html.twig",["pubs"=>$pubs]);

    }


}
