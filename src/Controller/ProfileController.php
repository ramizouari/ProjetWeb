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

        //$user=$request->request->get('user');

       /* try {
            $rep=$this->getDoctrine()->getRepository("App:Publication");
            $rep2=$this->getDoctrine()->getRepository("App:User");
            $pubs=$rep->findBy(array("proprietaire"=>$rep2->find($id)),array("proprietaire"=>"ASC"));

        }*/
        //catch (Exception $e ){

            $pubs=null ;
    //}

        return$this->render("profile/journale.html.twig",["pubs"=>$pubs,"user"=>$this->getUser()]);

    }


    /**
     * @Route("/meslivres" , name="meslivres")
     */

    public function meslivres()
    {

        $rep=$this->getDoctrine()->getRepository("App:UserBook");
        $livres=$rep->findBy(["userId"=>$this->getUser()->getId()]);

        $rep2=$this->getDoctrine()->getRepository("App:Book");
        $meslivre=array();
        $i=0;
      foreach ($livres as $livre){

          $meslivre[$i]=$rep2->findOneBy(["id"=>$livre->getBookId()]);
            $i++;
           }

        return $this->render("profile/meslivres.html.twig",array("meslivres"=>$meslivre, "user"=>$this->getUser()));

    }

}
