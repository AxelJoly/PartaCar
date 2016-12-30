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
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddTravelController extends Controller
{
    /**
     * @Route("/newTravelForm", name = "newTravelForm")
     */

    public function createTravelFormAction(Request $request)
    {
        $city = $this->getDoctrine()->getRepository('AppBundle:City')->findAll();


        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT name FROM AppBundle\Entity\City name');
        $tests = $query->getArrayResult();



        dump($city);
        if ($this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $user = $this->container->get('security.token_storage')->getToken()->getUser();

        }

        $travel = new Travel();

        $form = $this->createFormBuilder($travel)


            ->add('date',DateTimeType::class, array(
            'date_widget' => "single_text",
            'time_widget' => "single_text",
            'label' => 'Date',
        ))
            ->add('time', TimeType::class, array(
                'label' => 'temps estimé',
                'widget' => 'single_text',
                'attr' => ['class' => 'range-field']

            ))
            ->add('emptySeat',ChoiceType::class, array(
                'label' => 'Nombre de passagers',
                'choices' => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4'),
                'choice_label' => function ($value) {return strtoupper($value);},
                'attr' => ['class' => 'browser-default']
            ))

            ->add('description',TextType::class)
            ->add('valider', SubmitType::class, array('label' => 'Proposer le trajet', 'attr' => ['class' => 'btn waves-effect waves-light']))->getForm();


        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $travel->setDriver($user);
            $start = $request->get('start');
            $end = $request->get('end');

            $travel->setStart($this->getDoctrine()->getRepository('AppBundle:Travel')->find($start));
            $travel->setEnd($this->getDoctrine()->getRepository('AppBundle:Travel')->find($end));

            $em = $this->getDoctrine()->getManager();
            $em->persist($travel);
            $em->flush();
            $travel = $this->getDoctrine()->getRepository('AppBundle:Travel')->findAll();
            return $this->redirectToRoute('home', array('user' => $user, 'travel' => $travel));
        }

        return $this->render('AppBundle:Travel:travelform.html.twig', array('city' => $city, 'user' => $user, 'form' => $form->createView()));
    }


}
