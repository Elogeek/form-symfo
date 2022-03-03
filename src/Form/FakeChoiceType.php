<?php

namespace App\Form;

use App\Entity\FakeChoiceEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\Loader\CallbackChoiceLoader;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\CurrencyType;
use Symfony\Component\Form\Extension\Core\Type\LanguageType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FakeChoiceType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder
            ->add('choiceString', ChoiceType::class, [
                'label' => 'Values du form sous forme de strings',
                'placeholder' => 'Faites votre choix - strings',
                'choices' => [
                    'Choix 1 - string' => 'Premier choix',
                    'Choix 2 - string' => 'Second choix',
                    'Choix 3 - string' => 'Troisième choix',
                ],
                'choice_attr' => [
                    'Choix 1' => ['data-attribut' => 3],
                    'Choix 2' => ['data-attribut' => 8],
                    'Choix 3' => ['data-attribut' => 'hello world !'],
                ]
            ])

            // Valeurs sous forme de integers
            ->add('choiceInt', ChoiceType::class, [
                'label' => "Values form sous forme d'integers",
                //"placeholder" => "Faites votre choix - integers",
                'choices' => [
                    'Choix 1 - integer' => 5,
                    'Choix 2 - integer' => 9,
                    'Choix 3 - integer' => 7,
                    'Choix 4' => 15,
                    'Choix autre' => 55,
                ],

               'preferred_choices' => [5,55],

               'group_by' => function($choice, $key, $value) {
                    if($value <= 10) {
                        return 'Plus petit que 10';
                    }
                    return 'Plus grand que 10';
               },
                'multiple' => false,
                'expanded' => true,
            ])

            ->add('choiceBool', ChoiceType::class, [
                'label' => 'Values form sous forme de booleans',
                'placeholder' => 'Faites votre choix - booleans',
                'choices' => [
                    'Choix 1 - boolean' => true,
                    'Choix 2 - boolean' => false,
                ],
            ])
            // Add field pays
            ->add('country', CountryType::class, [
                'label' => 'Choisissez un pays',
            ])
            // Add field languages
            ->add('language', LanguageType::class, [
                'label' => 'Choisissez une langue',
            ])
            // Add field money
            ->add('money', CurrencyType::class, [
                'label' => 'Choisissez une devise',
            ])
        ;
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FakeChoiceEntity::class,
        ]);
    }
}
