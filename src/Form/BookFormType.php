<?php

namespace App\Form;

use App\Entity\Book;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class BookFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('author')
            ->add('description',TextareaType::class)
            ->add('category',ChoiceType::class,['choices'  => [
                'Drama' => 0,
                'Romantic' => 1,
                'Philosophy' => 2,
            ]])
            ->add('pagesNumber',IntegerType::class)
            ->add('year',IntegerType::class)
            ->add('save',SubmitType::class,['label' => 'Add Book',"attr"=>
            ["class"=>"btn btn-outline-success my-2 my-sm-0"]])        
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
