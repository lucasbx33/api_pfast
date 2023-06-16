<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeleteUserController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/api/users/delete/{id}', name: 'api_delete_user', methods: ['DELETE'])]
    public function deleteUser(User $user): Response
    {
        // Vérifiez si l'utilisateur existe
        if (!$user) {
            throw $this->createNotFoundException('Utilisateur non trouvé.');
        }

        // Supprimez l'utilisateur
        $this->entityManager->remove($user);
        $this->entityManager->flush();

        return new Response('Utilisateur supprimé avec succès.');
    }
}
