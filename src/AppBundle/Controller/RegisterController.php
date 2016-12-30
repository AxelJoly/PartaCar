<?php
/**
 * Created by PhpStorm.
 * User: axel
 * Date: 19/11/2016
 * Time: 23:43
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use AppBundle\Forms\RegisterType;

class RegisterController extends Controller
{
    /**
     * @Route("/register", name="register")
     */
    public function registerAction(Request $request)
    {
        $user = new User();
        $user->setRegisterDate(new \DateTime());
        $user->setNbTravel(0);
        $user->setActivity(1);
        $user->setRoles(["ROLE_USER"]);
        $form = $this->createForm(RegisterType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

        	//HASH du password
        	$plainPassword = $user->getPassword();
        	$encoder = $this->container->get('security.password_encoder');
        	$encoded = $encoder->encodePassword($user, $plainPassword);
        	
        	$user->setPassword($encoded);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('home');
        }

       // return $this->render('AppBundle:Register:register.html.twig', array());

        return $this->render('AppBundle:Register:register.html.twig', array('form' => $form->createView()));
    }
}