<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class)
            ->add('email', EmailType::class)
            ->add('password', PasswordType::class, [
                'mapped' => false,
                'constraints' => [
                    new Assert\NotBlank(message: 'Please enter a password.'),
                    new Assert\Length(
                        min: 8,
                        max: 4096,
                        minMessage: 'Your password must be at least {{ limit }} characters long.'
                    ),
                    new Assert\PasswordStrength(
                        minScore: Assert\PasswordStrength::STRENGTH_MEDIUM,
                        message: 'Your password is not strong enough.'
                    ),
                ],
            ])
            ->add('passwordConfirmation', PasswordType::class, [
                'mapped' => false,
                'constraints' => [
                    new Assert\NotBlank(message: 'Please confirm your password.'),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}