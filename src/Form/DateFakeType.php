<?php

namespace App\Form;

use App\Entity\DateFakeEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateIntervalType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\WeekType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DateFakeType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options): void {

        $years = new \DateTime();
        $builder
            ->add('date', DateType::class, [
                'widget' => "choice",
                "label" => "Date (DateType)",
                // Defined date format (ordre d'affichage)
                "format" => "dd-MM-yyy",
                // Defined a text (placeholder)
                "placeholder" => [
                    'day' => "Sélectionnez un jour",
                    'month' => "Sélectionnez un mois",
                    'year' => "Sélectionnez une année"
                ]
            ])
            ->add('dateInterval', DateIntervalType::class, [
                'label' => "Date d'ajout de l'article (DateInterval)",
                'with_seconds' => false,
                'with_minutes' => false,
                'with_hours' => true,
                'with_days' => true,
                'labels' => [
                    'years' => 'Années',
                    'months' => 'Mois',
                    'days' => 'Jours',
                    'hours' => 'Heures',

                ]
            ])
            ->add('dateTime', DateTimeType::class, [
                'label' => "Date (DateTimeType)",
                'date_widget' => 'single_text',
                'time_widget' => 'choice',
            ])
            ->add('time', TimeType::class)
            ->add('birthday',  BirthdayType::class, [
                'placeholder' => "Birthday",
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ])
            ->add('week', WeekType::class, [
                'widget' => 'choice',
                'years' => [2020, 2021, 2022],
                'weeks' => range(1,40),
                'label' => 'Date with TimeType'
            ])

            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void {
        $resolver->setDefaults([
            'data_class' => DateFakeEntity::class,
        ]);
    }

}
