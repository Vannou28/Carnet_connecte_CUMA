<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Material;
use App\Entity\WhereMaterial;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class WhereMaterialType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('material', EntityType::class, [
                'class' => Material::class,
                'label' => 'Matériels',
                'choice_label' => 'name',
            ])
            ->setMethod('GET')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => WhereMaterial::class,
        ]);
    }
}
