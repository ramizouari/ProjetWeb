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
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Evaluation;
use App\Form\BookFormType;
use Doctrine\ORM\ORMInvalidArgumentException;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Component\Form\FormError;

class LivreController extends AbstractController
{
    /**
     * @Route("/livre/{bookId}", name="livre",
     * requirements={
     * "bookId" : "\d+"
     * })
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
        $note=$evalRepo->getNoteOrZero($bookId,$this->getUser()->getId());
        $averageNote=0;//average note of all voting users
        $T=$evalRepo->getAverageNote($bookId);
        $averageNote=$T[0];
        $n=$T[1];
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
        return $this->render('livre/index.html.twig', ["book" => $book,
        "averageNote"=>$averageNote, "exchangesNumber"=>"Not supported Yet" ,
        "votersNumber"=>$n, "users"=>$owners,"followers"=>$followers,
        "isOwned"=>$isOwned,"isFollowed"=>$isFollowed,"note"=>$note]);
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
     * @Route("/livre/create",name="book_create")
     */
    public function createBook(Request $request)
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
        return $this->render("livre/create.html.twig",["book_form"=>$addBookForm->createView()]);
    }

    /**
     * @Route("/livre/{bookId}/add",name="book_add",requirements={"bookId"="^\d+$"})
     * @param Request $request
     * @return Response
     */
    public function addBook(Request $request,$bookId)
    {
        $userBook=new UserBook();
        $userBook->setUserId($this->getUser()->getId());
        $userBook->setBookId($bookId);      
        $manager = $this->getDoctrine()->getManager();
        try
        {
            $manager->persist($userBook);
            $manager->flush();
        }
        catch(ORMException $exc)
        {
            
        }
        catch(UniqueConstraintViolationException $constraint)
        {
            $repo=$manager->getRepository(Book::class);
            $manager->clear();
            return  new JsonResponse("<p>Book already owned</p>");
        }
        return new JsonResponse();
        }

    /**
     * @Route("/livre/{bookId}/remove",name="book_remove",requirements={"bookId"="^\d+$"})
     */
    public function removeBook(Request $request,$bookId)
    {
        $manager = $this->getDoctrine()->getManager();
        $repo=$this->getDoctrine()->getRepository(UserBook::class);
        $userBook=$repo->findOneBy(["userId"=>$this->getUser()->getId(),
        "bookId"=>$bookId]);
        try
        {
            $manager->remove($userBook);
            $manager->flush();
        }
        catch(ORMInvalidArgumentException $exc)
        {
            
        }
        catch(UniqueConstraintViolationException $constraint)
        {
            $repo=$manager->getRepository(Book::class);
            $manager->clear();
            return new JsonResponse("<p>Book is not owned</p>");
        }
        return new JsonResponse();
    }

     /**
     * @Route("/livre/{bookId}/follow",name="book_follow",requirements={"bookId"="^\d+$"})
     */
    public function followBook(Request $request,$bookId)
    {
        $userFollowedBook=new UserFollowedBook();
        $userFollowedBook->setUserId($this->getUser()->getId());
        $userFollowedBook->setBookId($bookId);      
        $manager = $this->getDoctrine()->getManager();
        try
        {
            $manager->persist($userFollowedBook);
            $manager->flush();
        }
        catch(ORMInvalidArgumentException $exc)
        {
            
        }
        catch(UniqueConstraintViolationException $constraint)
        {
            $repo=$manager->getRepository(Book::class);
            $manager->clear();
            return new JsonResponse("<p>Book already owned</p>");
        }
        return new JsonResponse();
    }

    /**
     * @Route("/livre/{bookId}/unfollow",name="book_unfollow",requirements={"bookId"="^\d+$"})
     */
    public function unfollowBook(Request $request,$bookId)
    {
        $manager = $this->getDoctrine()->getManager();
        $repo=$this->getDoctrine()->getRepository(UserFollowedBook::class);
        $userFollowedBook=$repo->findOneBy(["userId"=>$this->getUser()->getId(),
        "bookId"=>$bookId]);
        try
        {
            $manager->remove($userFollowedBook);
            $manager->flush();
        }
        catch(ORMInvalidArgumentException $exc)
        {
            
        }
        catch(UniqueConstraintViolationException $constraint)
        {
            $repo=$manager->getRepository(Book::class);
            $manager->clear();
            return new JsonResponse("<p>Book is not owned</p>");
        }
        return new JsonResponse(true);
    }

     /**
     * @Route("/livre/{bookId}/review/{note}",name="book_review",requirements={"bookId"="^\d+$","note"="^([1-9]|10)$"})
     */
    public function reviewBook(Request $request,$bookId,$note)
    {
        $manager = $this->getDoctrine()->getManager();
        $repo=$this->getDoctrine()->getRepository(Evaluation::class);
        $eval=$repo->findOneBy(["userId"=>$this->getUser()->getId(),
        "bookId"=>$bookId]);
        if(!$eval)
        {
            $eval = new Evaluation();
            $eval->setUserId($this->getUser()->getId());
            $eval->setBookId($bookId);
            $manager->persist($eval);
        }
        $eval->setNote($note);
        try
        {
            $manager->flush();
        }
        catch(ORMInvalidArgumentException $exc)
        {
            return new JsonResponse(false);
        }
        
        return new JsonResponse(true);
    }
}



