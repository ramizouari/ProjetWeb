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
use App\Form\BookFormType;
use Doctrine\ORM\ORMException;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Component\Form\FormError;

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
        if($n) {
            $note/=$n;
            $note=round($note,3);
        }
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
        $isOwned=$ownedBookRepo->findOneBy(["userId"=>$this->getUser()->getId()
        ,"bookId"=>$book->getId()])!=null;
        $isFollowed=$followedBookRepo->findOneBy
        (["userId"=>$this->getUser()->getId(),"bookId"=>$book->getId()])!=null;
        return $this->render('livre/index.html.twig', ["book" => $book,"note"=>$note,
        "exchangesNumber"=>"Not supported Yet" ,"votersNumber"=>$n, 
        "users"=>$owners,"followers"=>$followers,"isOwned"=>$isOwned,
        "isFollowed"=>$isFollowed]);
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

    /**
     * @Route("/livre/add",name="book_add")
     */
    public function add(Request $request)
    {
        $book=new Book();
        $addBookForm= $this->createForm (BookFormType::class,$book);
        $addBookForm->handleRequest($request);
        if($addBookForm->isSubmitted() && $addBookForm->isValid())
        {
            $book =$addBookForm->getData();
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($book);
            try
            {
                $manager->flush();
                return $this->redirectToRoute("welcome");
            }
            catch(ORMException $exc)
            {
                $addBookForm->addError(new FormError("Error while connecting to database"));
            }
            catch(UniqueConstraintViolationException $constraint)
            {
                $repo=$manager->getRepository(Book::class);
                $repo->findOneBy(["title"=>$book->getTitle(),"author"=>$book->getAuthor()]);
                $manager->clear();
                $addBookForm->addError(new FormError("Book already exists"));

            }
        }
        return $this->render("livre/add.html.twig",["book_form"=>$addBookForm->createView()]);
    }

    /**
     * @Route("/livre/{bookId}",name="book_add_collection")
     */
    public function add_collection(Request $request,$bookId)
    {
        $book=new Book();
        $addBookForm= $this->createForm (BookFormType::class,$book);
        $addBookForm->handleRequest($request);
        if($addBookForm->isSubmitted() && $addBookForm->isValid())
        {
            $book =$addBookForm->getData();
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($book);
            try
            {
                $manager->flush();
                return $this->redirectToRoute("welcome");
            }
            catch(ORMException $exc)
            {
                $addBookForm->addError(new FormError("Error while connecting to database"));
            }
            catch(UniqueConstraintViolationException $constraint)
            {
                $repo=$manager->getRepository(Book::class);
                $repo->findOneBy(["title"=>$book->getTitle(),"author"=>$book->getAuthor()]);
                $manager->clear();
                $addBookForm->addError(new FormError("Book already exists"));

            }
        }
        return $this->render("livre/add.html.twig",["book_form"=>$addBookForm->createView()]);
    }
}



