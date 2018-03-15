<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoginType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder

            ->add('username', TextType::class, [
                'label' => false,
                'required' => true,
                'error_bubbling' => true,
                'attr' => [
                    'placeholder' => 'User Name',
                    'class' => 'form-control'
                ]])
            ->add('password', PasswordType::class, [
                'label' => false,
                'required' => true,
                'error_bubbling' => true,
                'attr' => [
                    'placeholder' => 'Password',
                    'class' => 'form-control'
                ]])
            ->add('submit', SubmitType::class, [
                'label' => 'Login',
                'attr' => array(
                    'class' => 'btn btn-default submit btn-danger btn-block'
                )])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'user';
    }
}