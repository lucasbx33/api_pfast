<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CheckTokenController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/api/checkToken', name: 'check_token', methods: ['POST'])]
    public function checkToken(Request $request): Response
    {
        $token = $request->headers->get('token');

        if (!$token) {
            throw $this->createNotFoundException('Token not provided.');
        }

        $userRepository = $this->entityManager->getRepository(User::class);
        $user = $userRepository->findOneBy(['token' => $token]);

        if (!$user) {
            throw $this->createNotFoundException('User not found.');
        }

        return new Response('Token exists.', Response::HTTP_OK);
    }
}
