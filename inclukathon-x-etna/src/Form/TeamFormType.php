<?php

namespace App\Form;

use App\Entity\Teams;
use App\Entity\Companies;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class TeamFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                'class' => 'form-control mb-3'
                
                ]   
            ])
            ->add('enabled', CheckboxType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-check-input ml-3 mb-3'
                ]
            ])
            ->add('projectDescription', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control mb-3'
                ]
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Add Team',
                'attr' => [
                    'class' => 'btn btn-primary mt-3 '
                ]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Teams::class,
        ]);
    }
}
