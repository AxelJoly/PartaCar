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
            $mail=$request->get('mail');
            $user->setMail($mail);
            $user->setPassword($request->get('password'));
            $user->setLastName($request->get('lastname'));
            $user->setFirstName($request->get('firstname'));
            $user->setPseudo($request->get('pseudo'));
            $datetime=new \DateTime($request->get('birthday'));
            $user->setBirthday($datetime);
            $user->setSchool($request->get('school'));
            $user->setDescription($request->get('description'));
            $user->setActivity(1);
            $user->setProfilePic($request->get('profilePic'));
            $user->setRegisterDate(new \DateTime());
            /** Si les champs obligatoires ne sont pas remplis */

            if ($user->getMail() && $user->getPassword() && $user->getFirstName() && $user->getLastName() && $user->getBirthday() && $user->getSchool() && $user->getPseudo() && $user->getPhoneNumber() != NULL) {
                $em = $this->getDoctrine()->getManager();
                $query = $em->createQuery('SELECT mail FROM AppBundle\Entity\User mail WHERE mail.mail = :mail');
                $query->setParameters(array(
                    'mail' => $mail,
                ));
                $check = $query->getResult();


                if($check == NULL){ /** si le mail existe pas  */
                    $em->persist($user);
                    $em->flush();
                    return $this->redirectToRoute('home');
                }

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
    public function loginAction(Request $request){
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
