<?php

namespace App\Controller;

use App\Entity\ArticleBisEntity;
use App\Form\ArticleBisType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleBisController extends AbstractController
{
    #[Route('/articleBis/add', name: 'articleBis_add')]
    public function add(Request $request, EntityManagerInterface $entityManager): Response {
        $article_formulaire = new ArticleBisEntity();
        $form = $this->createForm(ArticleBisType::class, $article_formulaire);

        $form->handleRequest($request);
        // If the form is submitted and valid then we save it in db
        if($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($article_formulaire);
            $entityManager->flush();
        }
        // If there is an error redirection to the good view
        return $this->render('article_bis/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
