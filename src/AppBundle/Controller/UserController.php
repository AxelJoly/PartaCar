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

}
