<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class newEmailType extends AbstractType{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)  {
        
        $builder
            ->add('app', EntityType::class, [
                'label' => false,
                'required' => true,
                'error_bubbling' => true,
                'placeholder' => 'Select Resource',
                'class' => 'App:SendyApps',
                'choice_label' => 'app_name',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('template_name', TextType::class, [
                'label' => false,
                'required' => true,
                'error_bubbling' => true,
                'attr' => [
                    'placeholder' => 'Template Name',
                    'class' => 'form-control'
                ]])
            ->add('htmltext', FileType::class, [
                'label' => false,
                'required' => true,
                'error_bubbling' => true,
                'attr' => [
                    'action' => 'newemailtempl',
                    'class' => 'form-control'
                ]])
            ->add('submit', SubmitType::class, [
                'label' => 'Create Template',
                'attr' => [
                    'class' => 'btn btn-success btn-block'
                ]])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => 'App\Entity\Template'
        ]);
    }
    /**
     * @return string
     */
    public function getName() {
        return 'newemail';
    }
}
