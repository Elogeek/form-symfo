<?php

namespace App\Controller;

use App\Entity\DateFakeEntity;
use App\Form\DateFakeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DateFakeEntityController extends AbstractController {

    #[Route('/date_form/add', name: 'form_add')]
    public function add(Request $request, EntityManagerInterface $entityManager): Response {
        $date = new DateFakeEntity();
        $form = $this->createForm(DateFakeType::class, $date);

        $form->handleRequest($request);
        // If the form is submitted and valid then we save it in db
        if($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($date);
            $entityManager->flush();
        }
        // If there is an error redirection to the good view
        return $this->render('date/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
