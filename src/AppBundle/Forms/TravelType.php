<?php

/**
 * Created by PhpStorm.
 * User: axel
 * Date: 30/12/2016
 * Time: 15:00
 */
namespace AppBundle\Forms;


use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use AppBundle\Entity\Travel;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;



class TravelType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('emptySeat', ChoiceType::class, array(
                'label' => 'Nombre de passagers',
                'choices' => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4'),
                'choice_label' => function ($value) {
                    return strtoupper($value);
                },
                'attr' => ['class' => 'browser-default']
            ))
            ->add('description',TextareaType::class, array(
            		'attr' => ['id' => 'textarea' , 'class' => 'materialize-textarea', 'length' => 1000],
            ));

    }

        public function	configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults(array('travel_class' => Travel::class));
    }



}