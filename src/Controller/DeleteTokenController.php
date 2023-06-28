<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeleteTokenController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/api/deleteToken', name: 'delete_token', methods: ['POST'])]
    public function deleteToken(Request $request): Response
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

        // Remove token from user
        $user->setToken(null);
        $this->entityManager->flush();

        return new Response('Token deleted successfully.', Response::HTTP_OK);
    }
}
