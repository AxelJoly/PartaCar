<?php

namespace AppBundle\Forms;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use AppBundle\Entity\Event;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
        ->add('nom', TextType::class)
        ->add('date', DateTimeType::class, array(
        		'date_widget' => "single_text",
        		'time_widget' => "single_text",
        		'label' => 'Date',
        ))
            ->add('lieu',TextareaType::class, array(
            		'attr' => ['id' => 'textarea' , 'class' => 'materialize-textarea', 'length' => 500],
            ))
            ->add('description',TextareaType::class, array(
            		'attr' => ['id' => 'textarea' , 'class' => 'materialize-textarea', 'length' => 1000],
            ));
    }


    public function	configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults(array('date_class' => Event::class));
    }

}