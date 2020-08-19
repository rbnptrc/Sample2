<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('address', null, [
                'label' => 'Your Address: *',
                'attr' => [
                    'class' => 'form-control',
                ], ])
            ->add('city', null, [
                'label' => 'Your City: *',
                'attr' => [
                    'class' => 'form-control',
                ], ])
            ->add('zip', NumberType::class, [
                'label' => 'Zip: *',
                'attr' => [
                    'class' => 'form-control',
                ], ])
            ->add('tel_number', NumberType::class, [
                'label' => 'Your Phone Number: *',
                'attr' => [
                    'class' => 'form-control',
                ], ])
            ->add('email', null, [
                'label' => 'Email: *',
                'attr' => [
                    'class' => 'form-control',
                ], ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'label' => 'Password: *',
                'attr' => ['class' => 'form-control'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])

            ->add('save', SubmitType::class, ['label' => 'Submit',
                'attr' => ['class' => 'btn btn-primary my-3'], ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
