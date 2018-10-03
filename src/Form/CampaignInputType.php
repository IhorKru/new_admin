<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimezoneType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\LocaleType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CampaignInputType extends AbstractType {
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $builder
            ->add('traffic_type', EntityType::class,[
                'label' => false,
                'required' => true,
                'error_bubbling' => true,
                'placeholder' => 'Traffic Type',
                'class' => 'App:RefWebTrafficTypeDetails',
                'choice_label' => 'traffic_type_name',
                'attr' => [
                    'class' => 'form-control',
                    'id'=> "ex3p"
                ]
            ])
            ->add('partnername', EntityType::class, [
                'label' => false,
                'required' => true,
                'error_bubbling' => true,
                'placeholder' => 'Select Partner',
                'class' => 'App:PartnerDetails',
                'choice_label' => 'partner_name',
                'attr' => [
                    'class' => 'form-control',
                    'id'=> "ex3p"
                    ]])
            ->add('geo', CountryType::class, [
                'label' => false,
                'required' => false,
                'error_bubbling' => true,
                'placeholder' => 'Select User Geo',
                'attr' => [
                    'class' => 'select2_multiple form-control'
                ]
            ])
            ->add('resourcename', EntityType::class, [
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
            ->add('templatename', EntityType::class, [
                'label' => false,
                'required' => true,
                'error_bubbling' => true,
                'placeholder' => 'Select Template',
                'class' => 'App:Template',
                'choice_label' => 'template_name',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('numemails', TextType::class, [
                'label' => false,
                'required' => true,
                'error_bubbling' => true,
                'attr' => [
                    'placeholder' => 'Number of Campaigns',
                    'class' => 'form-control',
                    'id'=> "ex3"
                    ]
            ])
            ->add('timezone', TimezoneType::class, [
                'label' => false,
                'required' => true,
                'error_bubbling' => true,
                'placeholder' => 'Select Timezone',
                'attr' => [
                    'class' => 'form-control',
                    'id'=> "ex3"
                    ]
                ])
            ->add('datetosend', TextType::class, [
                'label' => false,
                'required' => true,
                'error_bubbling' => true,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Deployment Date',
                    'id' => "ex3"
                    ]])
            ->add('link1', UrlType::class, [
                'label' => false,
                'required' => false,
                'error_bubbling' => true,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Paid Click Link 1'
                ]])
            ->add('link2', UrlType::class, [
                'label' => false,
                'required' => false,
                'error_bubbling' => true,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Paid Click Link 2'
                ]])
            ->add('submit', SubmitType::class, [
                'label' => 'Generate Campaigns',
                'attr' => [
                    'class' => 'btn btn-success btn-block'
                ]])
            ->add('clear', ResetType::class, [
                'label' => 'Clear Fields',
                'attr' => [
                    'class' => 'btn btn-danger btn-block'
                ]])
             ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => 'App\Entity\CampaignInputDetails'
        ]);
    }

    /**
     * @return string
     */
    public function getName() {
        return 'input';
    }
}