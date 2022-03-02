<?php

namespace App\Form;

use App\Entity\FakeChoiceEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FakeChoiceType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder
            ->add('choiceString', ChoiceType::class, [
                'label' => 'Valeurs du form sous forme de strings',
                'placeholder' => 'Faites votre choix - strings',
                'choices' => [
                    'Choix 1 - string' => 'Premier choix',
                    ''
                ]
            ])
            ->add('choiceInt')
            ->add('choiceBool')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FakeChoiceEntity::class,
        ]);
    }
}
