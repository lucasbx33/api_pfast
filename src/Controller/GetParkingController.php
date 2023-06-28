<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;


class GetParkingController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/api/parking', name: 'get_parking_like', methods: ['GET'])]
    public function getUserParking(Request $request): JsonResponse
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

        $parking = $user->getParkingLike();
        $parkingJson = json_encode($parking);

        return new JsonResponse($parkingJson, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }
}
