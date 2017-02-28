<?php
/**
 * Created by PhpStorm.
 * User: axel
 * Date: 18/11/2016
 * Time: 22:08
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\AppBundle;
use AppBundle\Entity\Travel;
use AppBundle\Entity\City;
use AppBundle\Forms\TravelType;


class TravelController extends Controller
{

    /**
     * @Route("/travel/show/{event_id}", name="travel_show")
     */
    public function ShowTravelAction($event_id)
    {
        if( $this->container->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) )
        {
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
        }
        $travels = $this->getDoctrine()->getRepository('AppBundle:Travel') ->findBy(
                   array('event' => $event_id),  // $where 
                   array('emptySeat' => 'DESC'),   	 // $orderBy
                   100,                       	 // $limit
                   0                         	 // $offset
                 );
        
		

        return $this->render('AppBundle:Travel:travel.html.twig', array(
        		'user' => $user,
        		'travels' => $travels,
        		'event' => $this->getDoctrine()->getRepository('AppBundle:Event')->find($event_id)
        ));
    }

    /**
     * @Route("/travel/{id}", name="travelDetail")
     */
    /*
    public function ShowTravelDetail(Request $request, $id)
    {
        if( $this->container->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) )
        {
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
        }
        $id = $request->get('id');
        //  $request = Request::createFromGlobals();
        //  $id=$request->query->get('id');
        $travel=$this->getDoctrine()->getRepository('AppBundle:Travel')->find($id);
        // $travellers = $this->getDoctrine()->getRepository('AppBundle:Travel')->findBy(1);

        return $this->render('AppBundle:Travel:traveldetail.html.twig', array('user' => $user, 'travel' => $travel,));
    }
    */
    
    /**
     * @Route("/travel/add/{event_id}", name="travel_add")
     */
    public function addAction(Request $request, $event_id)
    {
    	if( $this->container->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) )
    	{
    		$user = $this->container->get('security.token_storage')->getToken()->getUser();
    	}
    	
    	$travel = new Travel();
    
    	$form = $this->createForm(TravelType::class,$travel);
    	$form->handleRequest($request);
    
    	if ($form->isSubmitted() && $form->isValid()) {
    
    		$travel->setDriver($user);
    		$event = $this->getDoctrine()->getRepository('AppBundle:Event')->find($event_id);
    		$travel->setEvent($event);
    		
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($travel);
    		$em->flush();
    
    		return $this->redirectToRoute('travel_show', array(
    				'event_id' => $event_id
    				
    		));
    	}
    	return $this->render('AppBundle:Travel:add.html.twig', array(
    			'form' => $form->createView(),
    			'user' => $user,
    	));
    }
    
    /**
     * @Route("/travel/delete/{event_id}/{id}", name="travel_delete")
     */
    public function deleteAction($event_id,Travel $id)
    {
    	$travel = $this->getDoctrine()->getRepository( 'AppBundle:Travel' )->find($id);
    	$em = $this->getDoctrine()->getManager();
    	$em->remove($travel);
    	$em->flush();
    
    	return $this->redirectToRoute('travel_show', array(
    			'event_id' => $event_id
    	));
    }
}








