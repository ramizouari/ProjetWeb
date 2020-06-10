<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;


class SignInType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username',TextType::class,['label'=> "Username"])
            ->add('email',EmailType::class,['label'=> "Email"])
            ->add('firstName',TextType::class,['label'=> "First Name"])
            ->add('lastName',TextType::class,['label'=> "Last Name"])
            ->add("plainPassword",PasswordType::class,['label'=> "Password"])
            ->add('save', SubmitType::class, ['label' => 'Sign In',
                "attr"=>["class"=>"btn btn-primary"]])
        ;
       
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
