<?php

namespace App\Form;

use App\Entity\Questions;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class QuestionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('question', TextType::class, [
                "attr" => [
                    "class" => 'form-control'
                ]
            ])
            ->add('enabled', CheckboxType::class,[
                "attr" => [
                    "class" => 'form-check-input pointer'
                ]
            ])
            ->add('answerExplanation', TextareaType::class, [
                "attr" => [
                    "class" => 'form-control'
                ]
            ])
            ->add('typeMedia', ChoiceType::class, [
                'choices'  => [
                    'Image' => 'image',
                    'Vidéo' => 'Vidéo',
                    'Audio' => 'Audio',
                ],
                "attr" => [
                    "class" => 'form-control'
                ]
            ])
            ->add('PathMedia', FileType::class, [
                "attr" => [
                    "class" => 'form-control'],
                    'data_class' => null
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Questions::class,
        ]);
    }
}
