<?php

namespace App\Form;

use App\Entity\ArticleBisEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\NotBlank;

class ArticleBisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => "Titre de l'article",
            ])
            ->add('content', TextareaType::class, [
                'label' => "Entrez le contenu de l'article"
            ])
            ->add('dateAdd', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('attachment',FileType::class,[
                'label' => "Ajoutez une capture d'écran",
                'required' => false,
                'constraints' => [
                    new Image([
                        'maxSize' => '3M',
                        'maxSizeMessage' => "L'image est trop lourde",
                        'sizeNotDetectedMessage' => "Impossible de déterminer la taille de l'image",
                        "detectCorrupted" => true
                    ])
                ]
            ])
            ->add('isPublished', CheckboxType::class,[
                'label' => "Publier directement l'article ?"
            ])
            ->add('cover', FileType::class, [
                'label' => "Upload la couverture de l'article",
                "mapped" => false,
            ])
            ->add('reset', ResetType::class, [
                'label' => "Refresh"
            ])
            ->add('save', SubmitType::class, [
                'label' => "Sauvegarder"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ArticleBisEntity::class,
        ]);
    }
}
