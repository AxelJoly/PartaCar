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


class TravelController extends Controller
{
    /**
     * @Route("/travel", name="travel")
     */
    public function ShowTravelAction()
    {
        return $this->render('AppBundle:Default:travel.html.twig', array());
    }
}