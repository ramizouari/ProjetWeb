<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
<<<<<<< HEAD
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
=======
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

>>>>>>> 0985da7569f599d074b8f63d8a3d0630f2138583


class SignInType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
<<<<<<< HEAD
            ->add('username',TextType::class,['label'=> "Username"])
            ->add('email',EmailType::class,['label'=> "Email"])
            ->add('firstName',TextType::class,['label'=> "First Name"])
            ->add('lastName',TextType::class,['label'=> "Last Name"])
            ->add("plainPassword",PasswordType::class,['label'=> "Password"])
            ->add('save', SubmitType::class, ['label' => 'Sign In',
                "attr"=>["class"=>"btn btn-primary"]])
        ;
       
=======
        ->add('email',EmailType::class,['label'=> "Email"])
        ->add("plainPassword",PasswordType::class,['label'=> "Password"])
        ->add("rememberSession",CheckboxType::class,["required"=>false])
        ->add('save', SubmitType::class, ['label' => 'Sign In',"attr"=>
            ["class"=>"btn btn-outline-success my-2 my-sm-0",
            ]])
    ;
>>>>>>> 0985da7569f599d074b8f63d8a3d0630f2138583
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
