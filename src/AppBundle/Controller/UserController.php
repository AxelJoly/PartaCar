<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    /**
     * @Route("/createUser", name="createUser")
     */
    public function createUserAction()
    {
        return $this->render('AppBundle:User:create_user.html.twig', array(

        ));
    }

    /**
     * @Route("/home", name = "home")
     */
    public function LoginAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        if($request->isMethod('post')){
            $mail = $request->get('mail');
            $password = $request->get('password');

            $query = $em->createQuery('SELECT mail FROM AppBundle\Entity\User mail WHERE mail.mail = :mail AND mail.password = :password');

            $query->setParameters(array(
                'mail' => $mail,
                'password' => $password,
            ));
            $check = $query->getResult();

            if($check != NULL){

                $user = $this->getDoctrine()->getRepository('AppBundle:User')->find($mail);


                return $this->redirectToRoute('travel', array('pseudo' => $user->getPseudo()));
            }

        }
         return $this->render('AppBundle:Default:index.html.twig', array());
    }
}
