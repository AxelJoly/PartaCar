<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;

class UserController extends Controller
{
/*
    /**
     * @Route("/register", name = "register")
     */
 /*   public function createUserAction(Request $request)
    {
        if ($request->isMethod('post')) {
            $user = new User();
            $user->setPhoneNumber($request->get('phoneNumber'));
            $user->setCarType($request->get('carType'));
            $user->setNbTravel(0);
            $mail=$request->get('mail');
            $user->setMail($mail);
            
            //HASH du mdp
            $passwordH = password_hash($request->get('password'), PASSWORD_BCRYPT);
            $user->setPassword($passwordH);
            
            $user->setLastName($request->get('lastname'));
            $user->setFirstName($request->get('firstname'));
            $user->setPseudo($request->get('pseudo'));
            $datetime=new \DateTime($request->get('birthday'));
            $user->setBirthday($datetime);
            $user->setSchool($request->get('school'));
            $user->setDescription($request->get('description'));
            $user->setActivity(1);
            $user->setProfilePic($request->get('profilePic'));
            $user->setRegisterDate(new \DateTime());

            //Role user quand on s'inscrit
            $user->setRoles(["ROLE_USER"]);
            
            
            /** Si les champs obligatoires ne sont pas remplis */

        /*    if ($user->getMail() && $user->getPassword() && $user->getFirstName() && $user->getLastName() && $user->getBirthday() && $user->getSchool() && $user->getPseudo() && $user->getPhoneNumber() != NULL) {
                $em = $this->getDoctrine()->getManager();
                $query = $em->createQuery('SELECT mail FROM AppBundle\Entity\User mail WHERE mail.mail = :mail');
                $query->setParameters(array(
                    'mail' => $mail,
                ));
                $check = $query->getResult();


                if($check == NULL){ /** si le mail existe pas  */
            /*        $em->persist($user);
                    $em->flush();
                    return $this->redirectToRoute('home');
                }

            } else
            {
                return $this->render('AppBundle:Register:register.html.twig', array());

            }
        }

        return $this->render('AppBundle:Register:register.html.twig', array());
    }*/
    
    
    /**
     * @Route("/login", name="app.login")
     *
     */
    public function loginAction()
    {

    	$authenticationUtils = $this->get('security.authentication_utils');
    	 
    	$error = $authenticationUtils->getLastAuthenticationError();
    	 
    	$lastUsername = $authenticationUtils->getLastUsername();


    	 
    	return $this->render('AppBundle:Default:index.html.twig', array(
    			'last_username' => $lastUsername,
    			'error' => $error
    	));
    }
    
    /**
     * @Route("/logout", name="app.logout")
     */
    public function logoutAction()
    {
    }
    
    
    /**
     * @Route("/profile", name="profile")
     *
     */
    
    public function profileAction()
    {   if( $this->container->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) )
        {
            $user = $this->container->get('security.token_storage')->getToken()->getUser();

        }
        return $this->render('AppBundle:User:profile.html.twig', array('user' => $user, 'profile' => $user));
    }

    /**
     * @Route("/profile/{pseudo}", name="foreignProfile")
     *
     */

    public function ForeignProfileAction($pseudo)
    {
        if ($this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $user = $this->container->get('security.token_storage')->getToken()->getUser();

        }

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT userz FROM AppBundle\Entity\User userz WHERE userz.pseudo = :pseudo');
        $query->setParameters(array(
            'pseudo' => $pseudo,
        ));
        $check = $query->getResult();
        dump($check);

        if ($check == NULL) {
            /** si le mail existe pas  */

            return $this->redirectToRoute('home');


        } else {


            return $this->render('AppBundle:User:profile.html.twig', array('user' => $user, 'profile' => $check));
        }


    }
}
    	
 
    
    
    
    
 

