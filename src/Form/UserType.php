<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',null,[
                'row_attr'  =>  ['class' => 'w3-section'],
                'attr' =>  ['class' => 'w3-input w3-border']
            ])
            ->add('email',EmailType::class,[
                'row_attr'  =>  ['class' => 'w3-section'],
                'attr'      =>  ['class' => 'w3-input w3-border']
            ])
            ->add('password',RepeatedType::class,[
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'options' => [
                    'row_attr'  =>  ['class' => 'w3-section'],
                    'attr' =>  ['class' => 'w3-input w3-border']
                ],
                'required' => true,
                'first_options'  => ['label' => 'Password'],
                'second_options' => ['label' => 'Repeat Password']
            ])
            ->add('roles',ChoiceType::class,[
                'multiple' => true,
                'expanded' => true,
                'choices' => [
                    'ROLE_ADMIN' => 'ROLE_ADMIN',
                    'ROLE_EDITOR' => 'ROLE_EDITOR',
                    'ROLE_VIP' => 'ROLE_VIP'
                ],
                'row_attr'  =>  ['class' => 'w3-section']
            ])
            ->add('isValidated',null,[
                'row_attr'  =>  ['class' => 'w3-section']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
