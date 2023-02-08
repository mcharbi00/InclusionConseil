<?php

namespace App\Form;

use App\Entity\Incluscore;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class IncluscoreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                "attr" => [
                    "class" => 'form-control'
                ]
            ])
            ->add('smallName', TextType::class, [
                "attr" => [
                    "class" => 'form-control'
                ]
            ])
            ->add('enabled', CheckboxType::class,[
                "attr" => [
                    "class" => 'form-check-input pointer'
                ]
            ])
            ->add('canBePublic', CheckboxType::class,[
                "attr" => [
                    "class" => 'form-check-input pointer'
                ]
            ])
            ->add('description', TextareaType::class, [
                "attr" => [
                    "class" => 'form-control'
                ]
            ])
            ->add('isInclucard', CheckboxType::class,[
                "attr" => [
                    "class" => 'form-check-input pointer'
                ]
            ])
            ->add('inclucardColor', ColorType::class)
            ->add('incluscoreColor', ColorType::class)
            ->add('secondIncluscoreColor', ColorType::class)
            ->add('displayNewStudentNumber', CheckboxType::class,[
                "attr" => [
                    "class" => 'form-check-input pointer'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Incluscore::class,
        ]);
    }
}
