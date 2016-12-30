<?php
/**
 * Created by PhpStorm.
 * User: axel
 * Date: 30/12/2016
 * Time: 14:56
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\AppBundle;
use AppBundle\Entity\Travel;
use AppBundle\Entity\City;
use AppBundle\Forms\addTravelType;

class AddTravelController extends Controller
{
    /**
     * @Route("/newTravelForm", name = "newTravelForm")
     */

    public function createTravelFormAction(Request $request)
    {
        $city = $this->getDoctrine()->getRepository('AppBundle:City')->findAll();
        if ($this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $user = $this->container->get('security.token_storage')->getToken()->getUser();

        }

        $travel = new Travel();
        $form = $this->createForm(addTravelType::class, $travel);

        $form->handleRequest($request);
        echo 'yolo';

        if ($form->isSubmitted() && $form->isValid()) {


            $em = $this->getDoctrine()->getManager();
            $em->persist($travel);
            $em->flush();

            return $this->redirectToRoute('home', array('user' => $user, 'city' => $city));
        }

        return $this->render('AppBundle:Travel:travelform.html.twig', array('user' => $user, 'form' => $form->createView()));
    }
}
