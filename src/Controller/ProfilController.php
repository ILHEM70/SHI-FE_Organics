<?php

namespace App\Controller;


use App\Form\ProfilType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

final class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function index(Request $request, EntityManagerInterface $entity): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(ProfilType::class, $user);

        $form = $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $entity->persist($data);

          

        
          

            return $this->redirectToRoute('app_profil');
        }

        return $this->render('profil/index.html.twig', [
            'controller_name' => 'Profil',
            'form' => $form->createView(),

        ]);
    }
}
