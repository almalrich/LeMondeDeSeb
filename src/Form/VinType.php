<?php

namespace App\Form;

use App\Entity\Mets;
use App\Entity\Vin;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VinType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('appelation')
            ->add('color')
            ->add('description')
            ->add('image')
            ->add('prix')
            ->add('mets',EntityType::class,['class'=>Mets::class,'choice_label'=>'title', 'multiple'=>true])

        ;


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vin::class,
        ]);
    }
}
