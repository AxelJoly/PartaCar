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

use Symfony\Component\Form\AbstractType;
use AppBundle\Entity\Travel;



class addTravelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('date',DateTimeType::class)
            ->add('time', TimeType::class, array('label' => 'temps estimé', 'attr' => ['class' => 'range-field']))
            ->add('emptySeat',ChoiceType::class)
            ->add('start',TextType::class)
            ->add('end',TextType::class)
            ->add('description',TextType::class)
            ->add('valider', SubmitType::class, array('label' => 'Proposer le trajet', 'attr' => ['class' => 'btn waves-effect waves-light']));
    }

    public function	configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults(array('travel_class' => Travel::class));
    }

}