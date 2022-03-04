<?php

namespace App\Controller;


use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request): Response {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            // Récupération des datas soumises au form
            $firstname = $form->get('firstname')->getData();
            $lastname = $form->get('lastname')->getData();
            $mail = $form->get('mail')->getData();
            $url = $form->get('url')->getData();
            $file = $form->get('attachment')->getData();
            $message = $form->get('message')->getData();
        }

        return $this->render('contact/form.html.twig',[
            'contact_form' => $form->createView()
        ]);
    }



}
