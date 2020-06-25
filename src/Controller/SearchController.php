<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BookRepository;
use App\Entity\Book;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search")
     */
    public function search(Request $request)
    {
        $keyword=$request->query->get("search");
        $bookRepo=$this->getDoctrine()->getRepository(Book::class);
        $authorResults=$bookRepo->findByAuthorLike($keyword);
        $titleResults=$bookRepo->findByTitleLike($keyword);
        return $this->render('search/index.html.twig', [
            'booksByTitle' => $titleResults,
            'booksByAuthor'=> $authorResults,
            'keyword'=>$keyword
        ]);
    }
}
