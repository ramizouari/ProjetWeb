<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserFollowedBook;
use App\Form\UserType;
use Doctrine\ORM\Mapping\Id;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class WwController extends AbstractController
{
    private $passwordEncoder;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }


    /**
     * @Route("/settings",name="setting")
     */
    public function settings(SessionInterface $session, Request $request){
        $session->start();
        $user = $session->get("user");
        if (!$user){
            return $this->redirectToRoute('/signin');
        }
        else {
            return $this->render('user/settings.html.twig',['user'=>$user]);
        }
    }

    /**
     * @Route("/modifierprofil",name="modifierprofil")
     */
    public function modifierprofil(SessionInterface $session){
        $session->start();
        $user = $session->get("user");
        if (!$user){
            return $this->redirectToRoute('signin');
        }
        else {
            $form=$this->createForm(UserType::class,$user, [
                'action' => $this->generateUrl('setprofil')
            ]);
            return $this->render('user/editerprofil.html.twig',['form'=>$form->createView()]);
        }
    }

    /**
     *    * @Route("/setprofil",name="setprofil")
     */
    public function setprofil(SessionInterface $session,Request $request){
        $session->start();
        $user = $session->get("user");
        if (!$user){
            return $this->redirectToRoute('signin');
        }
        else {
            $form=$this->createForm(UserType::class);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $us =$request->request->get("user");
                $a= $form->getData();
                $EntityManager =$this->getDoctrine()->getManager();
                $theuser = $EntityManager->getRepository(User::class)->findOneBy(array('username' => $a->getusername()));
                $theuser->setUsername($us["username"]);
                $theuser->setEmail($us["email"]);
                $theuser->setFirstName($us["firstName"]);
                $theuser->setLastName($us["lastName"]);
                $theuser->setPasswordHash($this->passwordEncoder->encodePassword
                ($a,$us["passwordHash"]));

                $user->setUsername($us["username"]);
                $user->setEmail($us["email"]);
                $user->setFirstName($us["firstName"]);
                $user->setLastName($us["lastName"]);
                $user->setPasswordHash($us["passwordHash"]);
                $EntityManager->flush();
                $this->addFlash('success','profil est mise à jour');
            }

        }
        return $this->render('user/settings.html.twig',['user'=>$user]);
    }

    /**
     * @Route("/filaccueil",name="filaccueil")
     */
    public function filaccueil(SessionInterface $session,Request $request)
    {
        /* $session->start();
        $user = $session->get("user");
        if (!$user) {
            return $this->redirectToRoute('signin');
        } else {

          $EntityManager =$this->getDoctrine()->getManager();
        $books = $EntityManager->getRepository(UserFollowedBook::class)->findBy(array('$userId' => $user->getId()));
        foreach ($books as $us) {
            $pub = $EntityManager->getRepository(book::class)->findBy(array('$id' => $us->getBookId()));
               $the= $EntityManager->getRepository(User::class)->find($us->getUserId());
               for ($i=0;$i<count($pub)
                { $a[$i]= $the;}
            $pubs=array_merge($pubs,$pub);
            $b=array_merge($b,$a);
          }
        */
        $pubs=array('a'=>1,'b'=>2);
        $b=array('a'=>1,'b'=>2);
        /* tri tableau suivant date
        $length = count($array);
        for ($i = $length-1; $i>0 ; $i--) {
          for ($j=0; $j>$i-1; j++)
           {if pubs[$j]->getDate()>pubs[$j+1]->getDate()
                 {$elem=$pubs[$j-1];
                  $pubs[$j]=$pubs[$j-1];
                  $pubs[$j]=$elem;
                  $el=$b[$j-1];
                  $b[$j]=$b[$j-1];
                  $b[$j]=$el;
                      }
            }
        }
        */

            return $this->render('filaccueil.html.twig', [
                'pubs'=>$pubs,
                'user'=>$b
                ]);



    }
}

