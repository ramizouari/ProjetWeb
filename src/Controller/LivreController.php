<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\UserFollowedBook;
use App\Entity\UserBook;
use App\Entity\Book;
use App\Entity\Evaluation;
use App\Entity\Exchange;

class LivreController extends AbstractController
{
    /**
     * @Route("/livre/{bookId}", name="livre")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request ,$bookId): Response
    {
        ##  if(!isset($request["book_id"])){

        #    return $this->render("base.html.twig");
        #}

        $bookRepo = $this->getDoctrine()->getRepository(Book::class);
        $book = $bookRepo->find($bookId);
        $evalRepo= $this->getDoctrine()->getRepository(Evaluation::class);
        $evaluations=$evalRepo->findBy(["bookId"=>$book->getId()]);
        //$exchangesRepo = $this->getDoctrine()->getRepository(Exchange::class);
        //$exchanges = $exchangesRepo->findBy(["bookId"=>$book->getId()]);
        //$exchangesNumber=count($exchanges);
        $note=0;
        $n=count($evaluations);
        foreach($evaluations as $eval)
            $note+=$eval->getNote();
        if($n) $note/=$n;
        else $note=null;
           $ownedBookRepo=$this->getDoctrine()->getRepository(UserBook::class);
        $userRepo=$this->getDoctrine()->getRepository(User::class);
        $followedBookRepo=$this->getDoctrine()->getRepository(UserFollowedBook::class);
        $owners=array_map(function($T) use ($userRepo,$evalRepo,$bookId)
        {
            $user=$userRepo->find($T->getUserId());
            $eval=$evalRepo->findOneBy(["userId"=>$user->getId(),"bookId"=>$bookId]);
            $user->note=null;
            if($eval)
                $user->note=$eval->getNote();
            return $user;
        },$ownedBookRepo->findBy(["bookId"=>$book->getId()]));
        $followers=array_map(function($T) use ($userRepo,$evalRepo,$bookId)
        {
            $user=$userRepo->find($T->getUserId());
            $eval=$evalRepo->findOneBy(["userId"=>$user->getId(),"bookId"=>$bookId]);
            $user->note=null;
            if($eval)
                $user->note=$eval->getNote();
            return $user;
        },$followedBookRepo->findBy(["bookId"=>$book->getId()]));
        return $this->render('livre/index.html.twig', ["book" => $book,"note"=>$note,
        "exchangesNumber"=>"Not supported Yet" , "users"=>$owners,"followers"=>$followers]);
    }

    ///**
    // * @Route("/liste",name="liste")
     //*/

    //public function lister($book){

    //    $ownedBookRepo=$this->getDoctrine()->getRepository(UserBook::class);
    //    $userRepo=$this->getDoctrine()->getRepository(User::class);
    //    $followedBookRepo=$this->getDoctrine()->getRepository(UserFollowedBook::class);
    //    $owners=array_map(function($T) use ($userRepo)
    //    {
    //        return $userRepo->find($T->getUserId());
     //   },$ownedBookRepo->findBy(["bookId"=>$book->getId()]));
    //    $followers=array_map(function($T) use ($userRepo)
    //    {
    //        return $userRepo->find($T->getUserId());
    //    },$followedBookRepo->findBy(["bookId"=>$book->getId()]));
    //    return $this->render("livre/liste.html.twig", ["users"=>$owners,"followers"=>$followers]) ;

    //}
}



