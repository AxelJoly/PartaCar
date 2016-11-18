<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class UserController extends Controller
{
    /**
     * @Route("/createUser")
     */
    public function createUserAction()
    {
        return $this->render('AppBundle:User:create_user.html.twig', array(

        ));
    }

    /**
     * @Route("/login", name = "login")
     */
    public function LoginAction(Request $request){
        $mail = $request->get('email');
        $password = $request->get('password');
        $check = $this->find('mail', $mail);
        if($check != NULL){

            if($request->isMethod('post')){

                return $this->redirectToRoute('news_show', array('id' => $news->getId()));
            }

        }
        return $this->render('AppBundle:Default:show.html.twig', array('news' => $news));
    }

}
