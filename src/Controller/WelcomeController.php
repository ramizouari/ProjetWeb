<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\SignInType;
use App\Form\LogInType;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\ORM\ORMException;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;


class WelcomeController extends AbstractController
{
    private $passwordEncoder;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    /**
     * @Route("/", name="welcome")
     */
    public function welcome(SessionInterface $session,Request $request)
    {
        $session->start();
        $user = $session->get("user");
        if($user)
            return $this->redirectToRoute("success");
        $logInForm= $this->createForm (LogInType::class,$user);
        $logInForm->handleRequest($request);
        $signInForm= $this->createForm (SignInType::class,$user);
        $signInForm->handleRequest($request);
        if($signInForm->isSubmitted() && $signInForm->isValid())
        {
            $user =$signInForm->getData();
            $user->setPasswordHash($this->passwordEncoder->encodePassword
            ($user,$user->getPlainPassword()));
            $user->eraseCredentials();
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($user);
            try
            {$manager->flush();
            }
            catch(ORMException $exc)
            {
                    dd($exc);
            }
            catch(UniqueConstraintViolationException $constraint)
            {
                
                return $res= $this->redirectToRoute("exists");
            }
        }
        else  if($logInForm->isSubmitted())
        {
            $user =$logInForm->getData();
            $plainPassword=$user->getPlainPassword();
            $user->eraseCredentials();
            $userRepo = $this->getDoctrine()->getRepository(User::class);
           $user=$userRepo->findOneBy(["email"=>$user->getEmail()]);
           if(!$user || !$this->passwordEncoder->isPasswordValid($user,$plainPassword))
           {
            return $res= $this->redirectToRoute("exists");
           }
           $user = $session->set("user",$user);
            return $res= $this->redirectToRoute("welcome");
        }
        $res= $this->render('welcome/welcome.html.twig', [
            'controller_name' => 'WelcomeController','sign_in'=>$signInForm->createView(),
            "log_in"=>$logInForm->createView()
        ]);

        return $res;
    }

    /**
     * @Route("/exists", name="exists")
     */
    public function exists(Request $request)
    {
        //To do: redirect to sign page
        $res= $this->render('welcome/exists.html.twig');
        return $res;
    }

     /**
     * @Route("/success", name="success")
     */
    public function success(SessionInterface $session,Request $request)
    {
        if(!$session->get("user"))
            return $this->redirectToRoute("welcome");
        //To do: redirect to user's news feed page
        $res= $this->render('welcome/success.html.twig',["user"=>$session->get("user")]);
        return $res;
    }

    /**
     * @Route("/disconnect", name="disconnect")
     */
    public function disconnect(SessionInterface $session,Request $request)
    {
        $session->clear();
        return $this->redirectToRoute("welcome");
    }
}
