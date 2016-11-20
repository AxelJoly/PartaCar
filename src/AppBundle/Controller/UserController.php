<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;

class UserController extends Controller
{




    /**
     * @Route("/register", name = "register")
     */
    public function createUserAction(Request $request)
    {
        if ($request->isMethod('post')) {
            $user = new User();
            $user->setPhoneNumber($request->get('phoneNumber'));
            $user->setCarType($request->get('carType'));
            $user->setNbTravel(0);
            $user->setMail($request->get('mail'));
            $user->setPassword($request->get('password'));
            $user->setLastName($request->get('lastname'));
            $user->setFirstName($request->get('firstname'));
            $user->setPseudo($request->get('pseudo'));
            $datetime=new \DateTime($request->get('birthday'));
            $user->setBirthday($datetime);
            $user->setSchool($request->get('school'));
            $user->setDescription($request->get('description'));
            $user->setActivity($request->get('activity'));
            $user->setProfilePic($request->get('profilePic'));
            $user->setRegisterDate(new \DateTime());
            if ($user->getMail() && $user->getPassword() && $user->getFirstName() && $user->getLastName() && $user->getBirthday() && $user->getSchool() && $user->getPseudo() && $user->getPhoneNumber() != NULL) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
                return $this->redirectToRoute('homepage');
            } else
            {
                return $this->render('AppBundle:Register:register.html.twig', array());
            }
        }

        return $this->render('AppBundle:Register:register.html.twig', array());
    }

    /**
     * @Route("/", name = "home")
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

                return $this->redirectToRoute('travel', array('mail' => $user->getMail()));
            }

        }
         return $this->render('AppBundle:Default:index.html.twig', array());
    }
}
