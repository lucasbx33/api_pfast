<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserParkingController
{
    #[Route('/api/users/{id}/parking', name: 'api_parking', methods: ['GET'])]
    public function getUserParking(User $user): Response
    {
        $parking = $user->getParkingLike();
        $parkingJson = json_encode($parking);

        return new Response($parkingJson, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }
}
