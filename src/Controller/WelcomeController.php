<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
<<<<<<< HEAD
use Symfony\Component\Routing\Annotation\Route;
use App\Form\SignInType;
use App\Form\LogInType;
=======
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\SignUpType;
use App\Form\SignInType;
>>>>>>> 0985da7569f599d074b8f63d8a3d0630f2138583
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\ORM\ORMException;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
<<<<<<< HEAD

=======
use Symfony\Component\Form\FormError;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
>>>>>>> 0985da7569f599d074b8f63d8a3d0630f2138583

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
<<<<<<< HEAD
        $logInForm= $this->createForm (LogInType::class,$user);
        $logInForm->handleRequest($request);
        $signInForm= $this->createForm (SignInType::class,$user);
        $signInForm->handleRequest($request);
        if($signInForm->isSubmitted() && $signInForm->isValid())
        {
            $user =$signInForm->getData();
=======
        $signInForm= $this->createForm (SignInType::class,$user);
        $signInForm->handleRequest($request);
        $signUpForm= $this->createForm (SignUpType::class,$user);
        $signUpForm->handleRequest($request);
        if($signUpForm->isSubmitted() && $signUpForm->isValid())
        {
            $user =$signUpForm->getData();
>>>>>>> 0985da7569f599d074b8f63d8a3d0630f2138583
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
<<<<<<< HEAD
                
                return $res= $this->redirectToRoute("exists");
            }
        }
        else  if($logInForm->isSubmitted())
        {
            $user =$logInForm->getData();
=======
                return $res= $this->redirectToRoute("exists");
            }
        }
        else  if($signInForm->isSubmitted())
        {
            $user =$signInForm->getData();
>>>>>>> 0985da7569f599d074b8f63d8a3d0630f2138583
            $plainPassword=$user->getPlainPassword();
            $user->eraseCredentials();
            $userRepo = $this->getDoctrine()->getRepository(User::class);
           $user=$userRepo->findOneBy(["email"=>$user->getEmail()]);
           if(!$user || !$this->passwordEncoder->isPasswordValid($user,$plainPassword))
           {
<<<<<<< HEAD
            return $res= $this->redirectToRoute("exists");
           }
           $user = $session->set("user",$user);
            return $res= $this->redirectToRoute("welcome");
        }
        $res= $this->render('welcome/welcome.html.twig', [
            'controller_name' => 'WelcomeController','sign_in'=>$signInForm->createView(),
            "log_in"=>$logInForm->createView()
=======
            return $res= $this->redirectToRoute("signin");
           }
           $user = $session->set("user",$user);
            return $res= $this->redirectToRoute("welcome",["attempts"=>1]);
        }
        $res= $this->render('welcome/welcome.html.twig', [
            'controller_name' => 'WelcomeController','sign_up'=>$signUpForm->createView(),
            "sign_in"=>$signInForm->createView()
>>>>>>> 0985da7569f599d074b8f63d8a3d0630f2138583
        ]);

        return $res;
    }

    /**
     * @Route("/exists", name="exists")
     */
    public function exists(Request $request)
    {
        //To do: redirect to sign page
<<<<<<< HEAD
        $res= $this->render('welcome/exists.html.twig');
=======
        $res= $this->render('welcome/signup.html.twig');
>>>>>>> 0985da7569f599d074b8f63d8a3d0630f2138583
        return $res;
    }

     /**
     * @Route("/success", name="success")
     */
    public function success(SessionInterface $session,Request $request)
    {
<<<<<<< HEAD
        if(!$session->get("user"))
            return $this->redirectToRoute("welcome");
        //To do: redirect to user's news feed page
        $res= $this->render('welcome/success.html.twig',["user"=>$session->get("user")]);
=======
        if(!$this->getUser())
            return $this->redirectToRoute("welcome");
        //To do: redirect to user's news feed page
        $res= $this->render('welcome/success.html.twig',["user"=>$this->getUser()]);
>>>>>>> 0985da7569f599d074b8f63d8a3d0630f2138583
        return $res;
    }

    /**
<<<<<<< HEAD
     * @Route("/disconnect", name="disconnect")
     */
    public function disconnect(SessionInterface $session,Request $request)
=======
     * @Route("/signout", name="signout")
     */
    public function signout(SessionInterface $session,Request $request)
>>>>>>> 0985da7569f599d074b8f63d8a3d0630f2138583
    {
        $session->clear();
        return $this->redirectToRoute("welcome");
    }
<<<<<<< HEAD
=======

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
>>>>>>> 0985da7569f599d074b8f63d8a3d0630f2138583
}
