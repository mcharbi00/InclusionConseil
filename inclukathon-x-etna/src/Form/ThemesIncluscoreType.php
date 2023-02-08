<?php

namespace App\Form;

use App\Entity\ThemesIncluscore;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class ThemesIncluscoreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                "attr" => [
                    "class" => 'form-control'
                ]
            ])
            ->add('enabled', CheckboxType::class,[
                "attr" => [
                    "class" => 'form-check-input pointer'
                ]
            ])
            ->add('imgPath', FileType::class, [
                "attr" => [
                    "class" => 'form-control'],
                    'data_class' => null
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ThemesIncluscore::class,
        ]);
    }
}
