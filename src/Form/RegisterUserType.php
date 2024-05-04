<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class RegisterUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Votre adresse email',
                'attr' => [
                    'placeholder' => 'Indiquez votre adresse email'
                ],
            ])
            // ->add('password', PasswordType::class, [
            //     'label' => 'Votre mot de passe',
            //     'attr' => [
            //         'placeholder' => 'Indiquez votre mot de passe'
            //     ],
            // ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'contraints' => [
                    new Length([
                        'min' => 4,
                        'max' => 40,
                    ])
                ],
                'first_options'  => [
                    'label' => 'Votre mot de passe',
                    'attr' => [
                        'placeholder' => 'Indiquez votre mot de passe'
                    ],
                    'hash_property_path' => 'password'
                ],
                'second_options' => [
                    'label' => 'Confirmer votre mot de passe',
                    'attr' => [
                        'placeholder' => 'Confirmer votre mot de passe'
                    ],
                ],
                'mapped' => false,
            ])
            ->add('firstName', TextType::class, [
                'label' => 'Votre prénom',
                'contraints' => [
                    new Length([
                        'min' => 2,
                        'max' => 40,
                    ])
                ],
                'attr' => [
                    'placeholder' => 'Indiquez votre prénom'
                ],
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Votre nom',
                'contraints' => [
                    new Length([
                        'min' => 2,
                        'max' => 40,
                    ])
                ],
                'attr' => [
                    'placeholder' => 'Indiquez votre nom'
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider',
                'attr' => [
                    'class' => 'btn-success'
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'contraints' => [
                new UniqueEntity([
                    'entityClass' => User::class,
                    'fields' => 'email',
                ])
            ],
            'data_class' => User::class,
        ]);
    }
}
