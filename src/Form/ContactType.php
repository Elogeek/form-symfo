<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotCompromisedPassword;
use Symfony\Component\Validator\Constraints\Unique;
use Symfony\Component\Validator\Constraints\Url;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // Le prénom de la personne souhaitant nous contacter
            ->add('firstname', TextType::class,[
                'label' => "votre prénom",
                'constraints' => array(
                    new NotBlank([
                        'message' => "Ce champ ne peut être vide"
                    ])
                )
            ])
            // Le nom de la personne souhaitant nous contacter
            ->add('lastname', TextType::class,[
                'label' => "Votre nom",
                'constraints' => array(
                    new NotBlank([
                        'message' => "Ce champ ne peut être vide"
                    ])
                )
             ])
            // L'email de la personne voulant nous contacter
            ->add("mail", EmailType::class, [
                'label' => "Votre email",
                'constraints' => array(
                    new NotBlank(),
                    new  Email([
                        'message' => "Adresse mail pas assez complexe",
                        'mode' => "html5"
                    ]),
                    new Length([
                        'min' => 5,
                        'minMessage' => "Adresse mail trop courte",
                        'max'=> 50,
                        'maxMessage' => "Adresse mail trop longue"
                    ]),
                    new Unique(),
                )
            ])
            // Eventuellement une url à nous fournir pour nous aider à résoudre le problème
            ->add('url', UrlType::class, [
                'label' => 'Entrez une url valide',
                'help' => "Une bonne url commence toujours oar htpps:\\\\",
                'default_protocol' => 'https://',
                'required' => false,
                'constraints' => [
                    new Url([
                        'message' => "L'url n'est pas correct/mauvais format",
                        'protocols' => [
                            'https',
                            'sftp'
                        ]
                    ])
                ]
            ])
            // Où un fichier sous forme d'image à nous fournir pour nous aider à résoudre le problème
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
            // Le message en question
            ->add('message', TextareaType::class, [
                'label' => "Votre message",
                'constraints' => [
                    new Length([
                        'min' => 40,
                        'minMessage' => "Message trop court",
                        'max' => 1500,
                        'maxMessage' => "Message trop long"
                    ])
                ]
            ])
            // Le btn submit
            ->add('submit',SubmitType::class, [
                'label' => "envoyer"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
