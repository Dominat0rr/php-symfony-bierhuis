<?php

namespace App\Form;

use App\Entity\Gebruiker;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GebruikerRegistratieFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('voornaam')
            ->add('familienaam')
            ->add('straat')
            ->add('huisnr')
            ->add('postcode')
            ->add('gemeente')
            ->add('gebruikersnaam')
            ->add("password", RepeatedType::class, [
                "type" => PasswordType::class,
                "required" => true,
                "first_options" => ["label" => "Password"],
                "second_options" => ["label" => "Herhaal Password"]
            ])
            ->add("Registreer", SubmitType::class, [
                "attr" => [
                    "class" => "btn btn-success float-left",
                    "style" => "width: 450px"
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Gebruiker::class,
        ]);
    }
}
