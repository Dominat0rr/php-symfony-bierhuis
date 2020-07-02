<?php

namespace App\Form;

use App\Entity\Bier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BierAantalFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("id", HiddenType::class, [
                'data_class' => null,
                'mapped' => false
            ])
            ->add("aantal", IntegerType::class)
            ->add("Toevoegen", SubmitType::class, [
                "attr" => [
                    "class" => "btn btn-primary float-left"
                ]
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bier::class,
        ]);
    }
}
