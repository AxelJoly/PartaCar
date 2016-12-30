<?php


use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use AppBundle\Entity\User;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add('mail',TextType::class)
            ->add('password',TextType::class);
    }


    public function	configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults(array('date_class' => User::class));
    }

}