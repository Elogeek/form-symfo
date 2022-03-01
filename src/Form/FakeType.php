<?php

namespace App\Form;

use App\Entity\FakeEntity;
use NumberFormatter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FakeType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder
            ->add('name', TextType::class, [
                'label' => "Entrez un nom fake",
                // Test fake data
                'data' => "Un super nom",
                // Help user
                'help' => "<p>text d'aide pour les utilisateurs</p>",
                'help_attr' => [
                    'class' => 'help_class_form',
                ],
                'help_html' => true,
                // Always false if not add
                //'disabled' => true,
                'required' => true, // Always true if not add
                // Value use if field not empty
                'empty_data' => "Anonymous",
                // Defined attributes Html supplementary
                'attr' => [
                    'class' => 'my_class_form',
                    'data_test'=>'value_data',
                ],
                // Defined attributes for field label
                'label_attr' => [
                    'class' => 'my_class_scss_label'
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Entrez une adresse mail',
                'attr' => [
                    'placeholder' => "example@gmail.com",
                    'class' => 'email_form_class'
                ]
            ])
            ->add('sign', TextareaType::class, [
                'label' => "Entrez la propriété Sign",
                'attr' => [
                    'rows' => 10,
                    'cols' => 10,
                ]
            ])
            ->add('age', IntegerType::class, [
                'rounding_mode' => NumberFormatter::ROUND_HALFUP,
                'label' => "Entrez votre âge",
            ])
            ->add('currency', MoneyType::class, [
                'label' => "Montant à appliquer",
                // Euro by default
                //'currency' => 'USD',
                'rounding_mode' => NumberFormatter::ROUND_HALFUP
            ])
            ->add('price', NumberType::class, [
                'label' => "Entrez un prix",
                'rounding_mode' => NumberFormatter::ROUND_HALFUP
            ])
            ->add('password', PasswordType::class, [
                'label' => "Entrez un mot de passe"
            ])
            ->add('url', UrlType::class, [
                'label' => "Entrez une url valide",
                'help' => "Une url correct commence toujours par https:\\\\",
                'default_protocol' => 'https:\\',
            ])
            ->add('userRange', RangeType::class, [
                'label' => "Sélectionnez quelque chose",
                'help' => "gamme de prix",
                'attr' => [
                    'min' => 2,
                    'max' => 10,
                ]
            ])
            ->add('phone', TelType::class, [
                'label' => 'Entrez votre numéro de téléphone',
                'help' => 'Format: +32....'
            ])
            ->add('color', ColorType::class)

            /**
             * Add btn submit to form
             */
            ->add('save', SubmitType::class, [
                'label' => 'Enregister',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void {
        $resolver->setDefaults([
            'data_class' => FakeEntity::class,
        ]);
    }

}
