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
use Doctrine\ORM\EntityManager;



class addTravelType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('date', DateTimeType::class, array(
                'date_widget' => "single_text",
                'time_widget' => "single_text",
                'label' => 'Date',
            ))
            ->add('time', TimeType::class, array(
                'label' => 'temps estimé',
                'widget' => 'single_text',
                'attr' => ['class' => 'range-field']

            ))
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
        -> add("start", "choice",
            array("label" => "Type",
                "choices" => $this->fillBusinessUnit(),
                "attr" => array("class" => "form-control select2"),
                "empty_value" => 'All Business Units'))
            ->add('description', TextType::class)
            ->add('valider', SubmitType::class, array('label' => 'Proposer le trajet', 'attr' => ['class' => 'btn waves-effect waves-light']));

    }

        public function	configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults(array('travel_class' => Travel::class));
    }



}