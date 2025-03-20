<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class ProfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'attr' => ['placeholder' => 'Votre prénom']
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'attr' => ['placeholder' => 'Votre nom']
            ])
            ->add('email', EmailType::class, [
                'label' => 'E-mail',
                'attr' => ['placeholder' => 'Votre e-mail']
            ])
            ->add(
                'password',
                RepeatedType::class,
                [
                    'type' => PasswordType::class,
                    'first_options'  => [
                        'label' => 'Mot de passe',
                        'attr' => ['placeholder' => 'Votre mot de passe']
                    ],
                    'second_options' => [
                        'label' => 'Confirmer le mot de passe',
                        'attr' => ['placeholder' => 'Confirmer votre mot de passe']
                    ],
                    'invalid_message' => 'Les mots de passe doivent correspondre.',
                    'options' => ['attr' => ['password-field']],
                    'required' => true,

                    'constraints' => [
                        new NotBlank(['message' => 'Le mot de passe est obligatoire']),
                        new Length([
                            'min' => 10,
                            'max' => 50,
                            'minMessage' => 'Le mot de passe doit contenir au moins {{ limit }} caractères',
                            'maxMessage' => 'Le mot de passe ne peut pas dépasser {{ limit }} caractères',
                        ]),
                        new Regex([
                            'pattern' => '/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_])/',
                            'message' => 'Le mot de passe doit contenir au moins une majuscule, un chiffre et un caractère spécial.',
                        ]),
                        new Regex([
                            'pattern' => '/^\S*$/',
                            'message' => 'Le mot de passe ne doit pas contenir d\'espaces.',
                        ]),
                    ]
                    ])
            ->add('country', CountryType::class, [
                'label' => 'Pays',
                'choices' => $options['country_choices'],
                'placeholder' => 'Choisissez votre pays',
                'required' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => \App\Entity\User::class,
            'country_choices' => [],
        ]);
    }
}
