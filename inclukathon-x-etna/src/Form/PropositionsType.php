<?php

namespace App\Form;

use App\Entity\Propositions;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class PropositionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type', ChoiceType::class, [
                'choices'  => [
                    'Image' => 'Image',
                    'Text' => 'Text',
                    'Vidéo' => 'Vidéo',
                    'Audio' => 'Audio',
                ],
                "attr" => [
                    "class" => 'form-control'
                ]
            ])
            ->add('proposition', TextType::class, [
                "attr" => [
                    "class" => 'form-control'
                ],
                'required' => false
            ])
            ->add('enabled', CheckboxType::class,[
                "attr" => [
                    "class" => 'form-check-input pointer'
                ]
            ])
            ->add('isAGoodAnswer', CheckboxType::class,[
                "attr" => [
                    "class" => 'form-check-input pointer'
                ]
            ])
            ->add('propMedia', FileType::class, [
                "attr" => [
                    "class" => 'form-control'],
                    'data_class' => null
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Propositions::class,
        ]);
    }
}
