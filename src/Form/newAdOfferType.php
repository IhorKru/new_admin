<?php
/**
 * Created by PhpStorm.
 * User: ihorkruchynenko
 * Date: 07/05/2017
 * Time: 17:07
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class newAdOfferType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('offer_name', TextType::class, [
                'label' => false,
                'required' => true,
                'error_bubbling' => true,
                'attr' => [
                    'placeholder' => 'Offer Name',
                    'class' => 'form-control',
                    'id'=> "ex3"
                ]])
            ->add('partner', EntityType::class, [
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
            ->add('url', UrlType::class, [
                'label' => false,
                'required' => false,
                'error_bubbling' => true,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Offer URL'
                ]])
            ->add('geo', CountryType::class, [
                'label' => false,
                'required' => false,
                'error_bubbling' => true,
                'placeholder' => 'Traffic Geo',
                'attr' => [
                    'class' => 'select2_multiple form-control'
                ]])
            ->add('offer_status', EntityType::class, [
                'label' => false,
                'required' => true,
                'error_bubbling' => true,
                'placeholder' => 'Offer Status',
                'class' => 'App:RefOfferStatusDetails',
                'choice_label' => 'status_name',
                'attr' => [
                    'class' => 'form-control',
                    'id'=> "ex3p"
                ]])
            ->add('offer_desc', TextType::class, [
                'label' => false,
                'required' => true,
                'error_bubbling' => true,
                'attr' => [
                    'placeholder' => 'Offer Description',
                    'class' => 'form-control',
                    'id'=> "ex3"
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
            'data_class' => 'App\Entity\newAdOfferDetails'
        ]);
    }

    /**
     * @return string
     */
    public function getName() {
        return 'input';
    }
}