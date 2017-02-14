<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\AppBundle;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class EventController extends Controller {
	/**
	 * @Route("/event/add/{type}", name="event_add")
	 * @Security("has_role('ROLE_BDE','ROLE_BDS')")
	 */
	public function addAction($type) {
		if ($this->container->get ( 'security.authorization_checker' )->isGranted ( 'IS_AUTHENTICATED_FULLY' )) {
			$user = $this->container->get ( 'security.token_storage' )->getToken ()->getUser ();
		}
		
		return $this->render ( 'AppBundle:Event:add.html.twig', array (
				'user' => $user 
		) );
	}
	
	/**
	 * @Route("/", name="home")
	 * @Route("/home/{type}", name="home_type")
	 */
	public function showAction($type = "BDE") {
		if ($this->container->get ( 'security.authorization_checker' )->isGranted ( 'IS_AUTHENTICATED_FULLY' )) {
			$user = $this->container->get ( 'security.token_storage' )->getToken ()->getUser ();
		}
		$event = $this->getDoctrine ()->getRepository ( 'AppBundle:Event' )->findByType ( $type );
		
		return $this->render ( 'AppBundle:Event:show.html.twig', array (
				'user' => $user,
				'event' => $event,
				'typeEvent' => $type 
		) );
	}
}
