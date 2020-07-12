<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Exchange;
use App\Form\BookFormType;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ExchangeController extends AbstractController
{
    /**
     * @Route("/exchange", name="exchange")
     */
    public function index()
    {
        return $this->render('exchange/index.html.twig', [
            'controller_name' => 'ExchangeController',
        ]);
    }

    /**
     * @Route("/exchange_create/{requestedId}/{requestedName}/{requestedBookId}/{requestedBookName}",name="exchange_create")
     */
    public function createExchange(Request $request,$requestedId,$requestedName,$requestedBookId,$requestedBookName)
    {
        $echange= new Exchange();

        $echange->setResponderId($requestedId);
        $echange->setRequestedBookId($requestedBookId);
        $echange->setRequesterId($this->getUser()->getId());
        $echange->setState(0);

        $rep=$this->getDoctrine()->getRepository("App:UserBook");
        $livres=$rep->findBy(["userId"=>$this->getUser()->getId()]);
        $rep2=$this->getDoctrine()->getRepository("App:Book");
        $meslivres=array();
        $j=0;
        foreach ($livres as $livre){
            $meslivres[$j]=$rep2->findOneBy(["id"=>$livre->getBookId()]);
            $j++;
        }

        return $this->render("exchange/index.html.twig" ,array("echange"=>$echange,"requestedname"=>$requestedName,"requestedBook"=>$requestedBookName,"disponibles"=>$meslivres));


     }

    /**
     * @Route("exchange_validation",name="exchange_validation")
     */
    public function validateExchange(Request $request) {



        $echange=new Exchange();

        $echange->setState(0);
        $echange->setRequesterId($this->getUser()->getId());
        $echange->setRequestedBookId($request->query->get("requestedbookId"));
        $echange->setResponderId($request->query->get("requestedpersonId"));
        $echange->setRespondedBookId($request->query->get("book"));
        $echange->setRequestDate((new \DateTime($request->query->get("date"))));

         $this->getDoctrine()->getManager()->persist($echange);

         return $this->redirectToRoute("profile");





    }

}
