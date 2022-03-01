<?php

namespace App\Controller;

use App\Entity\FakeEntity;
use App\Form\FakeType;
use App\Repository\FakeEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FakeEntityController extends AbstractController {

    #[Route('/fake/add', name: 'fake_add')]
    public function add(Request $request, EntityManagerInterface $entityManager): Response {
        $fake_data = new FakeEntity();
        $form = $this->createForm(FakeType::class, $fake_data);

        $form->handleRequest($request);
        // If the form is submitted and valid then we save it in db
        if($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($fake_data);
            $entityManager->flush();
        }
        // If there is an error redirection to the good view
        return $this->render('fake_entity/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
