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
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options'  => ['label' => 'Mot de passe', 'attr' => ['placeholder' => 'Votre mot de passe']],
                'second_options' => ['label' => 'Confirmer le mot de passe', 'attr' => ['placeholder' => 'Confirmer votre mot de passe']],
                'invalid_message' => 'Les mots de passe doivent correspondre.',
                'required' => false, // Le mot de passe est optionnel, si l'utilisateur ne souhaite pas le changer
            ])
            ->add('country', CountryType::class, [
                'label' => 'Pays',
                'choices' => $options['country_choices'],  // Utiliser la liste des pays passée au formulaire
                'placeholder' => 'Choisissez votre pays',
                'required' => true,  // Le champ pays est requis
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => \App\Entity\User::class,  // L'entité User (ou une autre entité selon ton projet)
            'country_choices' => [],  // Option pour les pays
        ]);
    }
}
