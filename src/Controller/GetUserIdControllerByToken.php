<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetUserIdControllerByToken extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/api/getIdToken', name: 'api_user_id', methods: ['POST'])]
    public function getUserId(Request $request): Response
    {
        $token = $request->headers->get('Authorization');

        // Remplacez cette logique de récupération de l'utilisateur par la vôtre
        $userRepository = $this->entityManager->getRepository(User::class);
        $user = $userRepository->findOneBy(['token' => $token]);

        if (!$user) {
            throw $this->createNotFoundException('Utilisateur introuvable.');
        }

        $id = $user->getId();

        return new Response($id);
    }
}
