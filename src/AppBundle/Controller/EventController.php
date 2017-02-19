<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\AppBundle;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Event;
use AppBundle\Forms\EventType;

class EventController extends Controller {
	/**
	 * @Route("/event/add/{type}", name="event_add")
	 * @Security("has_role('ROLE_BDE','ROLE_BDS')")
	 */
	public function addAction(Request $request, $type) {
		if ($this->container->get ( 'security.authorization_checker' )->isGranted ( 'IS_AUTHENTICATED_FULLY' )) {
			$user = $this->container->get ( 'security.token_storage' )->getToken ()->getUser ();
		}
		$event = new Event();
		$event->setType($type);
		$event->setResponsableEvent($user);
		
		$form = $this->createForm ( EventType::class, $event );
		$form->handleRequest ($request );
		
		if ($form->isSubmitted () && $form->isValid ()) {
			
			$em = $this->getDoctrine()->getManager();
			$em->persist($event);
			$em->flush();
				
			return $this->redirectToRoute('home_type', array(
					'type' => $type
			));
		}
		
		return $this->render ( 'AppBundle:Event:add.html.twig', array (
				'user' => $user,
				'form' => $form->createView (),
				'eventType' => $type
		) );
	}

    /**
     * @Route("/event/modify/{type}/{id}", name="event_modify")
     * @Security("has_role('ROLE_BDE','ROLE_BDS')")
     */
    public function modifyEventAction(Request $request, $type, $id)
    {
        if ($this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
        }
        $event = $this->getDoctrine ()->getRepository ( 'AppBundle:Event' )->find($id);

        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();

            return $this->redirectToRoute('home_type', array(
            		'type' => $type
            ));
        }

        return $this->render('AppBundle:Event:modify.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
            'eventType' => $type
        ));
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
	
	/**
	 * @Route("/event/delete/{type}/{id}", name="event_delete")
	 * @Security("has_role('ROLE_BDE','ROLE_BDS')")
	 */
	public function deleteAction($type,Event $id)
	{
        $event = $this->getDoctrine ()->getRepository ( 'AppBundle:Event' )->find($id);
        dump($event);
		$em = $this->getDoctrine()->getManager();
		$em->remove($event);
		$em->flush();

		return $this->redirectToRoute('home_type', array(
				'type' => $type
		));
	}
}
