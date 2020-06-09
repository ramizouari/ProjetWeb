<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function mysql_xdevapi\getSession;

class LivreController extends AbstractController
{
    /**
     * @Route("/livre", name="livre")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request ): Response
    {
         $name="souheil";

        $sess = $request->getSession();
        $sess->set("name",$name);
        return $this->render('livre/index.html.twig', ["name" => "souheil",
                                            "desciption" => "bb",
                                                "auteur" => "au",
                                             "categorie" => "darama",
                                                "nb_ech" => "333",
                                              "nb_pages" => 333,
                                            "evaluation" => "33333",
                                                   "img" =>"https://upload.wikimedia.org/wikipedia/commons/thumb/3/3a/Cat03.jpg/1200px-Cat03.jpg"]);
    }


    /**
     * @Route("/liste",name="liste")
     */

    public function lister(){

        return $this->render("livre/liste.html.twig", [
            'controller_name' => 'ProfileController',
            "firstname"=>"souheil",
            "secondname"=>"benslama",
            "rate"=>"10"
        ]) ;
    }


}
