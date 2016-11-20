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

class RegisterController extends Controller
{
    /**
     * @Route("/register", name="register")
     */
    public function registerAction()
    {
        return $this->render('AppBundle:Register:register.html.twig', array(

        ));
    }
}