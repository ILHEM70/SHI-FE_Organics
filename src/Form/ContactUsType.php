<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ContactUsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'name',
                'required' => true,
                'attr' => ['placeholder' => 'Your name']
            ])
            ->add('lastname', TextType::class, [
                'label' => 'lastname',
                'required' => true,
                'attr' => ['placehlder' => 'your lastname']
            ])
            ->add('email', EmailType::class, [
                'label' => 'Adress Email',
                'required' => true
            ])
            ->add('message', TextareaType::class, [
                'label' => 'message',
                'required' => true,
                'attr' => ['placeholder' => 'write your message']
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
