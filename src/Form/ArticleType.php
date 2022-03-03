<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType {

    /*
     * Pour utiliser l'option choices, il faut créer une liste d'objets du type de votre Entité
     */
    private array $users;

    public function __construct(UserRepository $userRepository) {
        $this->users[] = $userRepository->find(1);
        $this->users[] = $userRepository->find(2);
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('content')
            ->add('dateAdd', DateType::class, [
                'widget' => 'single_text'
            ])
            // Author of the article
                ->add('user', EntityType::class, [
                    'class' => User::class,
                    'label' => " choisissez l'auteur de l'article",
                    'placeholder' => "Choisissez un auteur",
                    'required' => false,
                    // Return string === Id user-Email user
                    'choice_label' => function(User $user) {
                        return $user->getId() . '-'. $user->getEmail();
                    },
                    'choices' => $options['users']
            ])
            // Add field
            ->add('copies', null, [
                "mapped" => false,
            ])
            ->add('isPublished', CheckboxType::class, [
                'label' => "Publier cet article?",
                'required' => false,
            ])
            // Add field hidden token
            ->add('token', HiddenType::class, [
                'mapped' => false,
                'data' => "my_super_token"
            ])
            // Add field file
            ->add('fileCover', FileType::class, [
                'label' => "uploadez la couverture de l'article",
                "mapped" => false,
            ])
            // multiple submit
            ->add('save', SubmitType::class, [
                'label' => 'Sauvegarder',
            ])
            ->add('save_draft', SubmitType::class, [
                'label' => 'Sauvegarderr comme brouillon'
            ])

            // single submit
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void {
        $resolver->setDefaults([
            'data_class' => Article::class,
            'users' => [],
        ]);
    }

}
