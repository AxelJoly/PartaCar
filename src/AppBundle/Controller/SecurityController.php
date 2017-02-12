<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="app.login")
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

}

