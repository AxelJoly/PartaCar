<?php

/**
 * Created by PhpStorm.
 * User: axel
 * Date: 30/12/2016
 * Time: 15:00
 */
namespace AppBundle\Forms;


use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\City;
use Symfony\Component\Form\AbstractType;
use AppBundle\Entity\Travel;



class addTravelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('date',DateTimeType::class, array('widget' => 'single_text', 'html5' => false))
            ->add('time', TimeType::class, array('label' => 'temps estimé', 'attr' => ['class' => 'range-field']))
            ->add('emptySeat',ChoiceType::class)
            ->add('start',ChoiceType::class)
            ->add('end',ChoiceType::class)
            ->add('description',TextType::class)
            ->add('valider', SubmitType::class, array('label' => 'Proposer le trajet', 'attr' => ['class' => 'btn waves-effect waves-light']));
    }

    public function	configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults(array('travel_class' => Travel::class));
    }

    private function getCities()
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT name.name FROM AppBundle\Entity\City name');
        $tests = $query->getResult();
        $tab = [];





        $array= array_values($tests);

        for($i = 0; $i < count($array); $i++){
            $tab = $array[$i];
        }





        return $tab;
    }
}