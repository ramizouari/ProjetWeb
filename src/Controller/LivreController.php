<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function mysql_xdevapi\getSession;

class LivreController extends AbstractController
{
    /**
     * @Route("/livre/{id}", name="livre")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request ,$id): Response
    {
        ##  if(!isset($request["book_id"])){

        #    return $this->render("base.html.twig");
        #}

        $rep = $this->getDoctrine()->getRepository("App:Book");
        $book = $rep->find($id);

        return $this->render('livre/index.html.twig', ["book" => $book]);
    }

    /**
     * @Route("/liste",name="liste")
     */

    public function lister($book){

        $rep1=$this->getDoctrine()->getRepository("App:UserBook");
        $users=$rep1->findBybookId($book->getId());
        $rep2=$this->getDoctrine()->getRepository("App:User");
         $usersliste=array();
        $i=0;
        foreach ($users as $us){
           $usersliste[$i]=$rep2->find($us->getUserId());
        }

        $rep3=$this->getDoctrine()->getRepository("App:UserFollowedBook");
        $follows=$rep3->findBybookId($book->getId());
        $followersliste=array();
        $i=0;
        foreach ($follows as $foll){
            $followers[$i]=$rep2->find($foll->getUserId());
        }

        return $this->render("livre/liste.html.twig", ["users"=>$usersliste,"followers"=>$followersliste]) ;

    }


}
