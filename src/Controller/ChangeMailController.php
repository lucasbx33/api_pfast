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

    #[Route('/api/changemail', name: 'api_change_mail', methods: ['PUT'])]
    public function changeUserMail(Request $request): Response
    {
        $token = $request->headers->get('Authorization');

        if (!$token) {
            throw $this->createNotFoundException('Token not provided.');
        }

        $userRepository = $this->entityManager->getRepository(User::class);
        $user = $userRepository->findOneBy(['token' => $token]);

        if (!$user) {
            throw $this->createNotFoundException('User not found.');
        }

        $data = json_decode($request->getContent(), true);
        $newMail = $data['mail'];

        // Modifier l'adresse e-mail de l'utilisateur
        $user->setMail($newMail);
        $this->entityManager->flush();

        return new Response('Adresse e-mail modifiée avec succès.');
    }
}
