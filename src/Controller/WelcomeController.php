<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\SignUpType;
use App\Form\SignInType;
use App\Entity\UserBook;
use App\Entity\User;
use App\Entity\Book;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\ORM\ORMException;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Component\Form\FormError;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

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

        $signInForm= $this->createForm (SignInType::class,$user);
        $signInForm->handleRequest($request);
        $signUpForm= $this->createForm (SignUpType::class,$user);
        $signUpForm->handleRequest($request);
        if($signUpForm->isSubmitted() && $signUpForm->isValid())
        {
            $user =$signUpForm->getData();
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
        else  if($signInForm->isSubmitted())
        {
            $user =$signInForm->getData();
            $plainPassword=$user->getPlainPassword();
            $user->eraseCredentials();
            $userRepo = $this->getDoctrine()->getRepository(User::class);
           $user=$userRepo->findOneBy(["email"=>$user->getEmail()]);
           if(!$user || !$this->passwordEncoder->isPasswordValid($user,$plainPassword))
           {
            return $res= $this->redirectToRoute("signin");
           }
           $user = $session->set("user",$user);
            return $res= $this->redirectToRoute("welcome",["attempts"=>1]);
        }
        $res= $this->render('welcome/welcome.html.twig', [
            'controller_name' => 'WelcomeController','sign_up'=>$signUpForm->createView(),
            "sign_in"=>$signInForm->createView()
        ]);

        return $res;
    }

    /**
     * @Route("/exists", name="exists")
     */
    public function exists(Request $request)
    {
        //To do: redirect to sign page
        $res= $this->render('welcome/signup.html.twig');
        return $res;
    }

     /**
     * @Route("/success", name="success")
     */
    public function success(SessionInterface $session,Request $request)
    {
        if(!$this->getUser())
            return $this->redirectToRoute("welcome");
        //To do: redirect to user's news feed page
        $res= $this->render('welcome/success.html.twig',["user"=>$this->getUser()]);
        return $res;
    }

    /**
     * @Route("/signout", name="signout")
     */
    public function signout(SessionInterface $session,Request $request)
    {
        $session->clear();
        return $this->redirectToRoute("welcome");
    }

    /**
     * @Route("/signin", name="signin")
     */
    public function signin(SessionInterface $session,Request $request)
    {
        $user = $this->getUser();

        if($user)
            return $this->redirectToRoute("success");
        $signInForm= $this->createForm (SignInType::class,$user);
        $signInForm->handleRequest($request);
      if($signInForm->isSubmitted())
        {
            $user =$signInForm->getData();
            $plainPassword=$user->getPlainPassword();
            $user->eraseCredentials();
            $userRepo = $this->getDoctrine()->getRepository(User::class);
           $user=$userRepo->findOneBy(["email"=>$user->getEmail()]);
           if(!$user || !$this->passwordEncoder->isPasswordValid($user,$plainPassword))
            $signInForm->addError(new FormError("Incorrect Credentials"));
           else
            { 
                $user = $session->set("user",$user);
                return $res= $this->redirectToRoute("welcome");
            }
        }
        return $this->render("welcome/signin.html.twig",["sign_in"=>
        $signInForm->createView()]);
    }

      /**
     * @Route("/signup", name="signup")
     */
    public function signup(SessionInterface $session,Request $request)
    {
        $user = $this->getUser();
        if($user)
            return $this->redirectToRoute("success");
        $signUpForm= $this->createForm (SignUpType::class,$user);
        $signUpForm->handleRequest($request);
        if($signUpForm->isSubmitted() && $signUpForm->isValid())
        {
            $user =$signUpForm->getData();
            $user->setPasswordHash($this->passwordEncoder->encodePassword
            ($user,$user->getPlainPassword()));
            $user->eraseCredentials();
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($user);
            try
            {
                $manager->flush();
                $user = $session->set("user",$user);
                return $this->redirectToRoute("welcome");
            }
            catch(ORMException $exc)
            {
                    dd($exc);
            }
            catch(UniqueConstraintViolationException $constraint)
            {
                $manager->clear();
                $signUpForm->addError(new FormError("Username/Email already exists"));
            }
        }
        return $this->render("welcome/signup.html.twig",["sign_up"=>
        $signUpForm->createView()]);
    }

    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
         if ($this->getUser()) {
             return $this->redirectToRoute('success');
         }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    /**
     * @Route("/mybooks", name="user_books")
     */
    public function mybooks()
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('welcome');
        }
        $userBookRepo = $this->getDoctrine()->getRepository(UserBook::class);
        $userBooks=$userBookRepo->findBy(["userId"=>$this->getUser()->getId()]);
        $bookRepo=$this->getDoctrine()->getRepository(Book::class);
        $books=array();
        foreach($userBooks as $userBook)
           { array_push($books,$bookRepo->find($userBook->getBookId()));
           
           }
       return $this->render('user/books.html.twig', ['books' => $books]);    }    
}
