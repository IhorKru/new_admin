<?php
/**
 * Created by PhpStorm.
 * User: IKRUCHYNENKO
 * Date: 24-Jan-18
 * Time: 03:21 PM
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmailValidationType extends AbstractType {
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('numemails', TextType::class, [
                'label' => false,
                'required' => true,
                'error_bubbling' => true,
                'attr' => [
                    'placeholder' => 'Number of Emails',
                    'class' => 'form-control',
                    'id'=> "ex3"
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Validate Emails',
                'attr' => array(
                    'class' => 'btn btn-primary btn-block'
                )])
        ;
    }
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\newEmailCheck'
        ));
    }
    /**
     * @return string
     */
    public function getName() {
        return 'check';
    }
}