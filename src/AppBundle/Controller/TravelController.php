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
     * @Route("/travel", name="travel_show")
     */
    public function ShowTravelAction()
    {
        if( $this->container->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) )
        {
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
        }
        $travel = $this->getDoctrine()->getRepository('AppBundle:Travel')->findAll();
		

        return $this->render('AppBundle:Travel:travel.html.twig', array(
        		'user' => $user,
        		'travel' => $travel
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
     * @Route("/travel/add", name="travel_add")
     */
    public function addAction(Request $request)
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
    		
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($travel);
    		$em->flush();
    
    		return $this->redirectToRoute('home');
    	}
    	return $this->render('AppBundle:Travel:add.html.twig', array(
    			'form' => $form->createView(),
    			'user' => $user,
    	));
    }
    
    /**
     * @Route("/newTravelForm", name = "newTravelForm")
     */
    /*
    public function createTravelFormAction(Request $request)
    {
    
    
    	$city = $this->getDoctrine()->getRepository('AppBundle:City')->findAll();
    
    
    	$em = $this->getDoctrine()->getManager();
    	$query = $em->createQuery('SELECT name FROM AppBundle\Entity\City name');
    	$tests = $query->getArrayResult();
    
    
    
    	dump($city);
    	if ($this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
    		$user = $this->container->get('security.token_storage')->getToken()->getUser();
    
    	}
    
    	$travel = new Travel();
    
    	$form = $this->createFormBuilder($travel)
    
    
    	->add('date',DateTimeType::class, array(
    			'date_widget' => "single_text",
    			'time_widget' => "single_text",
    			'label' => 'Date',
    	))
    	->add('time', TimeType::class, array(
    			'label' => 'temps estimé',
    			'widget' => 'single_text',
    			'attr' => ['class' => 'range-field']
    
    	))
    	->add('emptySeat',ChoiceType::class, array(
    			'label' => 'Nombre de passagers',
    			'choices' => array(
    					'1' => '1',
    					'2' => '2',
    					'3' => '3',
    					'4' => '4'),
    			'choice_label' => function ($value) {return strtoupper($value);},
    			'attr' => ['class' => 'browser-default']
    			))
    
    			->add('start', EntityType::class, array(
    					'class' => 'AppBundle:City',
    					'choice_label' => 'name',
    					'attr' => ['class' => 'browser-default']
    			))
    
    			->add('end', EntityType::class, array(
    					'class' => 'AppBundle:City',
    					'choice_label' => 'name',
    					'attr' => ['class' => 'browser-default']
    			))
    
    
    			->add('description',TextType::class)
    			->add('valider', SubmitType::class, array('label' => 'Proposer le trajet', 'attr' => ['class' => 'btn waves-effect waves-light']))->getForm();
    
    			dump(array_values($tests));
    			$form->handleRequest($request);
    
    
    			if ($form->isSubmitted() && $form->isValid()) {
    				$travel->setDriver($user);
    				// dump($travel);
    
    				// Ca se passe ici Beeeeeeeen
    				// $travel->setStart($this->getDoctrine()->getRepository('AppBundle:Travel')->find($travel->getStart()));
    				// $travel->setEnd($this->getDoctrine()->getRepository('AppBundle:Travel')->find($travel->getEnd()));
    
    				$em = $this->getDoctrine()->getManager();
    				$em->persist($travel);
    				$em->flush();
    				$travel = $this->getDoctrine()->getRepository('AppBundle:Travel')->findAll();
    				return $this->redirectToRoute('home', array('user' => $user, 'travel' => $travel));
    			}
    
    			return $this->render('AppBundle:Travel:travelform.html.twig', array('city' => $city, 'user' => $user, 'form' => $form->createView()));
    }
    
    private function getCities($test){
    
    	for($i = 0; $i < count($test); $i++){
    
    		$tab[] = $test[$i]["name"];
    	}
    
    
    	return $tab;
    }*/
}








