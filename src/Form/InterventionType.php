<?php

namespace App\Form;

use App\Entity\Material;
use App\Entity\Intervention;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class InterventionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('material', EntityType::class, [
                'class' => Material::class,
                'label' => 'Matériels',
                'choice_label' => 'name',
            ])
            ->add('aera', TextType::class, [
                'required' => false,
                'label' => 'Sruface en Ha',])
            ->add('weight', TextType::class, [
                'required' => false,
                'label' => 'Nb de Tonne',])
            ->add('comment', TextType::class, [
                'required' => false,
                'label' => 'Si vous avez un commentaire à mettre',])
            ->add('dateIntervention', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de l\'intervention',])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Intervention::class,
        ]);
    }
}
