<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class)
            ->add(
                'roles',
                ChoiceType::class,
                [
                    "multiple" => true,
                    "choices" => [
                         "Role Admin" => "ROLE_ADMIN", "Role Employee" => "ROLE_EMPLOYEE", "Role Manager" => "ROLE_MANAGER"
                        ]
                ]
            )
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label' => 'Password'],
                'second_options' => ['label' => 'Repeat Password'],
            ])
            ->add('firstName')
            ->add('middleName')
            ->add('lastName')
            ->add('gender', ChoiceType::class, ["choices" => ["Male" => "M", "Female" => "F"]])
            ->add('dateOfBirth')
            ->add('userType')
			    ->add('department')
            ->add('profession');
          
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
