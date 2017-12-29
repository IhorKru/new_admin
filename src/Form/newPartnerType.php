<?php
/**
 * Created by PhpStorm.
 * User: ihorkruchynenko
 * Date: 03/05/2017
 * Time: 22:01
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class newPartnerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)  {
        $builder
            ->add('partner_name', TextType::class, [
                'label' => false,
                'required' => true,
                'error_bubbling' => true,
                'attr' => [
                    'placeholder' => 'Partner Name',
                    'class' => 'form-control'
                ]])
            ->add('partner_type', EntityType::class, [
                'label' => false,
                'required' => true,
                'error_bubbling' => true,
                'placeholder' => 'Partner Type',
                'class' => 'App:RefPartnerTypeDetails',
                'choice_label' => 'partner_type_name',
                'attr' => [
                    'class' => 'form-control'
                ]])
            ->add('traffic_type', EntityType::class, [
                'label' => false,
                'required' => true,
                'error_bubbling' => true,
                'placeholder' => 'Traffic Type',
                'class' => 'App:RefWebTrafficTypeDetails',
                'choice_label' => 'traffic_type_name',
                'attr' => [
                    'class' => 'form-control'
                ]])
            ->add('geo', CountryType::class, [
                'label' => false,
                'required' => false,
                'error_bubbling' => true,
                'placeholder' => 'Partner Location',
                'attr' => [
                    'class' => 'select2_multiple form-control'
                ]])
            ->add('size', TextType::class, [
                'label' => false,
                'required' => true,
                'error_bubbling' => true,
                'attr' => [
                    'placeholder' => 'Partner Size',
                    'class' => 'form-control'
                ]])
            ->add('tire', EntityType::class, [
                'label' => false,
                'required' => true,
                'error_bubbling' => true,
                'placeholder' => 'Tire',
                'class' => 'App:RefTireDetails',
                'choice_label' => 'tire_name',
                'attr' => [
                    'class' => 'form-control'
                ]])
            ->add('submit', SubmitType::class, [
                'label' => 'Create Partner',
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
            'data_class' => 'App\Entity\PartnerDetails'
        ]);
    }

    /**
     * @return string
     */
    public function getName() {
        return 'input';
    }
}