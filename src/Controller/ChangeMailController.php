<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ChangeMailController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/api/users/{id}/mail', name: 'api_change_mail', methods: ['PUT'])]
    public function changeUserMail(Request $request, User $user): Response
    {
        $data = json_decode($request->getContent(), true);
        $newMail = $data['mail'];

        // Vérifiez si l'utilisateur existe
        if (!$user) {
            throw $this->createNotFoundException('Utilisateur non trouvé.');
        }

        // Modifiez l'adresse e-mail de l'utilisateur
        $user->setMail($newMail);
        $this->entityManager->flush();

        return new Response('Adresse e-mail modifiée avec succès.');
    }
}
