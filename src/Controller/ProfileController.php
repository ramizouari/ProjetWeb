<?php

namespace App\Controller;

use Http\Client\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Exchange;
use App\Entity\Book;
use App\Entity\User;

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
        return$this->render("profile/journale.html.twig",["pubs"=>$pubs,"user"=>$this->getUser()]);  }


    /**
     * @Route("/meslivres" , name="meslivres")
     */
    public function meslivres(Request $request)
    {
        $rep=$this->getDoctrine()->getRepository("App:UserBook");
        $livres=$rep->findBy(["userId"=>$this->getUser()->getId()]);
        $rep2=$this->getDoctrine()->getRepository("App:Book");
        $meslivres=array();
        $j=0;
        foreach ($livres as $livre){
            $meslivres[$j]=$rep2->findOneBy(["id"=>$livre->getBookId()]);
            $j++;
        }
        $numb=count($meslivres);
        $pagenumb=($numb %12)? ((integer)($numb/12) +1) :($numb/12) ;
        $page=$request->query->get("page") ?? 1 ;
        if(($page<=0)){$page=1;}
        if($page>=$pagenumb) {$page=$pagenumb;}
        $pagetable=array();
        for($i=0;$i<12;$i++)
        {      if(($page==$pagenumb)&&(($i)==($numb%12)))
                {break;}
                $pagetable[$i]=$meslivres[($page-1)*12+$i];}
        return $this->render("profile/meslivres.html.twig",array("meslivres"=>$pagetable, "user"=>$this->getUser(),"nbpages"=>$pagenumb,"page"=>$page,"route"=>"meslivres"));

    }

    /**
     * @Route("/liv_abon" , name="livres_abonnements")
     */

    public function get_abon(Request $request)
    {
        $rep=$this->getDoctrine()->getRepository("App:UserFollowedBook");
        $livres=$rep->findBy(["userId"=>$this->getUser()->getId()]);
        $rep2=$this->getDoctrine()->getRepository("App:Book");
        $meslivres=array();
        $j=0;
        foreach ($livres as $livre){
            $meslivres[$j]=$rep2->findOneBy(["id"=>$livre->getBookId()]);
            $j++;
        }
        $numb=count($meslivres);
        $pagenumb=($numb %12)? ((integer)($numb/12) +1) :($numb/12) ;
        $page=$request->query->get("page") ?? 1 ;
        if(($page<=0)){$page=1;}
        if($page>=$pagenumb) {$page=$pagenumb;}
        $pagetable=array();
        for($i=0;$i<12;$i++)
        {
            if(($page==$pagenumb)&&(($i)==($numb%12)))
            {break;}
            $pagetable[$i]=$meslivres[($page-1)*12+$i];
        }
        return $this->render("profile/meslivres.html.twig",array("meslivres"=>$pagetable,"user"=>$this->getUser(),"nbpages"=>$pagenumb,"page"=>$page,"route"=>"livres_abonnements"));
    }



/**
 * @Route("/echanges" , name="echanges")
 *
 */

public function echanges(Request $request)
{
    $rep=$this->getDoctrine()->getRepository(Exchange::class);
    $requesterechanges=$rep->findBy(["requesterId"=>$this->getUser()->getId()]);
    $mesdemandes=array();
    $rep1=$this->getDoctrine()->getRepository(Book::class);
    $rep2=$this->getDoctrine()->getRepository(User::class);
    $i=0;
    foreach ($requesterechanges as $echange){
        $mesdemandes[$i]=["id"=>$echange->getId(),
            "requesteduser"=>$rep2->findOneBy(["id" => $echange->getResponderId()])->getUsername(),
            "requestedbook"=>$rep1->findOneBy(["id"=>$echange->getRequestedBookId()])->getTitle(),
            "availablebook"=>$rep1->findOneBy(["id"=>$echange->getRespondedBookId()])->getTitle()
                            ];
        $i++;
    }


    $responderechanges=$rep->findBy(["responderId"=>$this->getUser()->getId()]);
    $mesreceived=array();
    foreach ($responderechanges as $echange){
        $mesreceived[$i]=["id"=>$echange->getId(),
            "requesteruser"=>$rep2->findOneBy(["id" => $echange->getRequesterId()])->getUsername(),
            "requestedbook"=>$rep1->findOneBy(["id"=>$echange->getRequestedBookId()])->getTitle(),
            "availablebook"=>$rep1->findOneBy(["id"=>$echange->getRespondedBookId()])->getTitle()
        ];
        $i++;
    }

    //$demandesrecuesob=$rep->findBy(["responderId"=>$this->getUser()->getId()]);
    return $this->render("profile/mesechanges.html.twig",array("mesdemandes"=>$mesdemandes,"mesreponses"=>$mesreceived,"user"=>$this->getUser()));
}
}

