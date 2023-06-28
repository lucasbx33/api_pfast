<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ConnectController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/api/connect', name: 'connect', methods: ['POST'])]
    public function connect(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        $email = $data['email'];
        $password = $request->headers->get('Password');

        $userRepository = $this->entityManager->getRepository(User::class);
        $user = $userRepository->findOneBy(['mail' => $email]);

        if (!$user) {
            return new Response('Utilisateur introuvable', Response::HTTP_NOT_FOUND);
        }

        $hashedPassword = hash('sha512', $password);

        if ($user->getPassword() === $hashedPassword) {
            // Generate token
            $token = base64_encode(random_bytes(32));

            // Set token to user
            $user->setToken($token);
            $this->entityManager->flush();
            return new Response($token, Response::HTTP_OK);
        } else {
            return new Response('false', Response::HTTP_OK);
        }
    }
}