<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetUserIdControllerByMail extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/api/getIdMail', name: 'getIdMail', methods: ['POST'])]
    public function getUserId(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        $email = $data['email'];
    
        $userRepository = $this->entityManager->getRepository(User::class);
        $user = $userRepository->findOneBy(['mail' => $email]);
    
        if (!$user) {
            throw $this->createNotFoundException('Utilisateur introuvable.');
        }
    
        $id = $user->getId();
    
        return new Response($id);
    }

}
