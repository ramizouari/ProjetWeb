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

        $users=$book->getUsers() ;
        $rep=$this->getDoctrine()->getRepository("App:User");
        $followers=$rep->findByBfollowers("First11");

        return $this->render("livre/liste.html.twig", ["users"=>$users,"followers"=>$followers]) ;

    }


}
