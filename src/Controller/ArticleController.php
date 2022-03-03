<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\User;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController {

    /**
     * Return all articles
     * @param ArticleRepository $articleRepository
     * @return Response
     */
   #[Route('/articles', name: 'articles_list')]
   public function list(ArticleRepository $articleRepository): Response {
       $articleRepository->findAll();
       return $this->render('article/list.html.twig', [
           "articles" => $articleRepository->findAll()
       ]);
   }

    /**
     * Add a form in the article (template)
     */
    #[Route('/article/add', name: 'article_add')]
    public function add(Request $request, EntityManagerInterface $entityManager, ParameterBagInterface $parameterBag): Response {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article, [
            'users' => $entityManager->getRepository(User::class)->findAll(),
        ]);

        $form->handleRequest($request);
        // If the form is submitted and valid then we save it in db
        if($form->isSubmitted() && $form->isValid()) {
            $file = $form['fileCover']->getData();
            $ext = $file->guessExtension();
            if(!$ext) {
                // If not ext alors use ext générique
                $ext = 'txt';
            }
            // Déplacement du file and rename name unique
            $file->move($parameterBag->get("upload.directory"), uniqid(). "." .$ext);
            $entityManager->persist($article);
            $entityManager->flush();
        }
        // If there is an error redirection to the good view
        return $this->render('article/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Edit a form in the article
     */
    #[Route('/article/edit/{id}', name: 'article_edit')]
    public function edit(Article $article, Request $request, EntityManagerInterface $entityManager): Response {
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            // Check is save normal is cliked
            $published = $form->get('save')->isCliked();
            $article->setIsPublished($published);
        }
        // If the form is submitted and valid then we save it in db
        if($form->isSubmitted() && $form->isValid()) {
            // Handling clones
            $copiesCount = (int)$form->get('copies')->getData();
            // I start with 1, to find my way around more easily (1 === copy number reference without any other treatment)
            for($i = 1; $i <= $copiesCount; $i++) {
                $articleClone = new Article();
                $articleClone
                    ->setTitle($article->getTitle())
                    ->setContent($article->getContent() . "(copy {$i})")
                    ->setDateAdd(new \DateTime())
                ;
                // Warning do not forget persist otherwise Doctrine does not take this new entity into account
                $entityManager->persist($articleClone);
            }
            // Flush clone and change the article
            $entityManager->flush();
            $this->addFlash('success', "l'article a bien été mis à jour !");
            return $this->redirectToRoute('articles_list');
        }
        // If there is an error redirection to the good view
        return $this->render('article/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
