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


class TravelController extends Controller
{


    /**
     * @Route("/newTravelForm/{mail}", name = "newTravelForm")
     */
    public function createTravelFormAction(Request $request, $mail)
    {
        $city = $this->getDoctrine()->getRepository('AppBundle:City')->findAll();
        $user = $this->getDoctrine()->getRepository('AppBundle:User')->find($mail);
       // echo "ca passe 1";
        if ($user == NULL){
            return $this->redirectToRoute('home', array());

        }


        if ($request->isMethod('post')) {
            $travel = new Travel();
            $travel->setDriver($user);
            $start = $this->getDoctrine()->getRepository('AppBundle:City')->find($request->get('start'));
            $travel->setStart($start);
            $end = $this->getDoctrine()->getRepository('AppBundle:City')->find($request->get('end'));
            $travel->setEnd($end);
            $travel->setDate(new \DateTime());
            $travel->setEmptySeat((Integer)($request->get('emptySeat')));
            $travel->setDescription($request->get('description'));

          // if ($user->getMail() && $user->getPassword() && $user->getFirstName() && $user->getLastName() && $user->getBirthday() && $user->getSchool() && $user->getPseudo() && $user->getPhoneNumber() != NULL) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($travel);
            $em->flush();
            $travel2 = $this->getDoctrine()->getRepository('AppBundle:Travel')->findAll();
            return $this->render('AppBundle:Travel:travel.html.twig', array('user' => $user, 'travel' => $travel2));
            }


        return $this->render('AppBundle:Travel:travelform.html.twig', array('user' => $user, 'city' => $city));
    }




    /**
     * @Route("/travel/{mail}", name="travel")
     */
    public function ShowTravelAction($mail)
    {
        $user = $this->getDoctrine()->getRepository('AppBundle:User')->find($mail);
        if ($user == NULL){
            return $this->redirectToRoute('home', array());
        }


        $travel = $this->getDoctrine()->getRepository('AppBundle:Travel')->findAll();


        return $this->render('AppBundle:Travel:travel.html.twig', array('user' => $user, 'travel' => $travel, 'mail' => $user->getMail()));
    }
}