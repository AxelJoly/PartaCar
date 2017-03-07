<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use AppBundle\Forms\UserType;

/**
 * @Route("/user")
 */
class UserController extends Controller {
	/**
	 * @Route("/register", name="register")
	 */
	public function registerAction(Request $request) {
		$user = new User ();
		$user->setRegisterDate ( new \DateTime () );
		$user->setNbTravel ( 0 );
		$user->setActivity ( 1 );
		$user->setRoles ( [ 
				"ROLE_USER" 
		] );
		$form = $this->createForm ( UserType::class, $user );
		
		$form->handleRequest ( $request );
		
		if ($form->isSubmitted () && $form->isValid ()) {
			
			// HASH du password
			$plainPassword = $user->getPassword ();
			$encoder = $this->container->get ( 'security.password_encoder' );
			$encoded = $encoder->encodePassword ( $user, $plainPassword );
			
			$user->setPassword ( $encoded );
			
			$em = $this->getDoctrine ()->getManager ();
			$em->persist ( $user );
			$em->flush ();

			//Envoie du message de confirmation d'inscription
            $message = \Swift_Message::newInstance()
                ->setSubject('Validation inscription')
                ->setFrom('isen.partacar@gmail.com')
                ->setTo($user->getMail())
                ->setBody(
                    $this->renderView(
                        'AppBundle:Email:simpleMail.html.twig',
                        array()

                    ),
            'text/html'
                )
            ;

            $this->get('mailer')->send($message);

			return $this->redirectToRoute ( 'home' );
		}
		
		return $this->render ( 'AppBundle:User:register.html.twig', array (
				'form' => $form->createView () 
		) );
	}
	
	/**
	 * @Route("/show/{mail}", name="profile_show")
	 */
	public function ShowProfileAction($mail) {
		if ($this->container->get ( 'security.authorization_checker' )->isGranted ( 'IS_AUTHENTICATED_FULLY' )) {
			$user = $this->container->get ( 'security.token_storage' )->getToken ()->getUser ();
		}
		
		$em = $this->getDoctrine ()->getManager ();
		$query = $em->createQuery ( 'SELECT userz FROM AppBundle\Entity\User userz WHERE userz.mail = :mail' );
		$query->setParameters ( array (
				'mail' => $mail 
		) );
		$check = $query->getResult ();
		
		if ($check == NULL) {
			return $this->redirectToRoute ( 'home' );
		} else {
			
			return $this->render ( 'AppBundle:User:profile.html.twig', array (
					'user' => $user,
					'profile' => $check ['0'] 
			) );
		}
	}
}
    	
 
    
    
    
    
 

