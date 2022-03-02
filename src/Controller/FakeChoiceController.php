<?php

namespace App\Controller;

use App\Entity\FakeChoiceEntity;
use App\Form\FakeChoiceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FakeChoiceController extends AbstractController {

    #[Route('/fake/choice/add', name: 'fake_choice_add')]
    public function add(Request $request, EntityManagerInterface $entityManager): Response {
        $date = new FakeChoiceEntity();
        $form = $this->createForm(FakeChoiceType::class, $date);

        $form->handleRequest($request);
        // If the form is submitted and valid then we save it in db
        if($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($date);
            $entityManager->flush();
        }
        // If there is an error redirection to the good view
        return $this->render('fake_choice/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
