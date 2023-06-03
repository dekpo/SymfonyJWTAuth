<?php

namespace App\Form;

use App\Entity\Post;
use App\Entity\Category;
use App\Entity\Tag;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('category',EntityType::class,[
                'class' => Category::class,
                'choice_label' => 'name',
                'row_attr'  =>  ['class' => 'w3-section'],
                'attr'      =>  ['class' => 'w3-input w3-border']
            ])
            ->add('featured',null,[
                'row_attr'  =>  ['class' => 'w3-section']
            ])
            ->add('thumbnail',null,[
                'row_attr'  =>  ['class' => 'w3-section'],
                'attr'      =>  ['class' => 'w3-input w3-border']
            ])
            ->add('title',null,[
                'row_attr'  =>  ['class' => 'w3-section'],
                'attr'      =>  ['class' => 'w3-input w3-border']
            ])
            ->add('description',null,[
                'row_attr'  =>  ['class' => 'w3-section'],
                'attr'      =>  ['class' => 'w3-input w3-border']
            ])
            ->add('tags',EntityType::class,[
                'class' => Tag::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'row_attr'  =>  ['class' => 'w3-section']
            ])
            //->add('created_at')
            //->add('updated_at')
            // ->add('user')
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
