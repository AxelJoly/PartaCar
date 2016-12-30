<?php

/**
 * Created by PhpStorm.
 * User: axel
 * Date: 29/12/2016
 * Time: 19:17
 */
namespace AppBundle\Forms;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\AbstractType;
use AppBundle\Entity\User;


class RegisterType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options){

        $builder
            ->add('firstName',TextType::class)
            ->add('lastName',TextType::class)
            ->add('pseudo',TextType::class)
            ->add('mail',EmailType::class)
            ->add('password', PasswordType::class)
            ->add('phoneNumber', TextType::class)
            ->add('birthday', DateType::class,  array('widget' => 'text', 'format' => 'yyyy-MM-dd', 'attr' => ['class' => '']))
            ->add('school', ChoiceType::class, array( 'choices' => array(
                                                                            'ISEN Toulon' => 'isen',
                                                                            'Fac de Droit' => 'fac',
                                                                            'Ingémédia' => 'ingemedia'),
                'choice_label' => function ($value) {

                        return strtoupper($value);
                }, 'attr' => ['class' => 'browser-default']
            ))
            ->add('carType',TextType::class)
            ->add('description',TextareaType::class)
            ->add('profilePic',  FileType::class, array('required' => false, 'label' => 'Photo de profil  '))
            ->add('save', SubmitType::class, array('attr' => ['class' => 'btn waves-effect waves-light ']));
    }


    public function	configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults(array('user_class' => User::class));
    }

}