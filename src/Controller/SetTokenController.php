<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SetTokenController extends AbstractController
{
    #[Route('/api/setToken{id}', name: 'set_token', methods: ['POST'])]
    public function setToken(Request $request, int $id, EntityManagerInterface $entityManager): Response
    {
        $user = $entityManager->getRepository(User::class)->find($id);

        if (!$user) {
            throw $this->createNotFoundException('User not found.');
        }

        // Generate token
        $token = base64_encode(random_bytes(32));

        // Set token to user
        $user->setToken($token);
        $entityManager->flush();

        return new Response('Token set successfully.', Response::HTTP_OK);
    }
}
