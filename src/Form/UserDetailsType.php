<?php

namespace App\Form;

use App\Entity\UserDetails;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UserDetailsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Nom',])
            ->add('lastname', TextType::class, [
                'label' => 'Prénom',])
            ->add('address', TextType::class, [
                'label' => 'Adresse',])
            ->add('postalCode', TextType::class, [
                'label' => 'Code postal',])
            ->add('town', TextType::class, [
                'label' => 'Ville',])
            ->add('phone', TextType::class, [
                'label' => 'Numéro de mobile',])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserDetails::class,
        ]);
    }
}
