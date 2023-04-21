<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ContactRepository;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\Persistence\ManagerRegistry;
class   ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function createAction(ManagerRegistry $doctrine, Request $request, SluggerInterface $slugger)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->persist($contact);
            $em->flush();

            $this->addFlash(
                'notice',
                'Contact Sented'
            );
            return $this->redirectToRoute('home');
        }
        return $this->renderForm('contact/index.html.twig', ['form' => $form,]);
    }
    #[Route('/contact/delete/{id}', name: 'contact_delete')]
    public function deleteAction(ManagerRegistry $doctrine,$id)
    {
        $em = $doctrine->getManager();
        $contact = $em->getRepository('App\Entity\Contact')->find($id);
        $em->remove($contact);
        $em->flush();

        $this->addFlash(
            'error',
            'Contact deleted'
        );
        return $this->redirectToRoute('admin_list');
    }
}
