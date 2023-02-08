<?php

namespace App\Form;

use App\Entity\Companies;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CompanyFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Nom de la société',
                    'class' => 'form-control'
                ]
            ])
            ->add('imgPath', FileType::class, [
                'label' => 'Choisir un logo',
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'class' => 'form-control-file'
                ],
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/gif'
                        ],
                        'mimeTypesMessage' => 'Image invalide',
                    ])
                ],
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Ajouter ou modifier',
                'attr' => [
                    'class' => 'btn btn-primary mt-3 '
                ]])
        ;

        ;
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Companies::class,
            'attr' => [
                'novalidate' => 'novalidate'
            ]
        ]);
    }
}