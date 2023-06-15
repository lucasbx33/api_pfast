<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;


class SetParkLike extends AbstractController
{
    #[Route('/api/setparklike/{id}', name: 'api_set_parklike', methods: ['POST'])]
public function addUserParking(Request $request, User $user, EntityManagerInterface $entityManager): JsonResponse
{
    $parkingToAdd = $request->getContent();
    $existingParking = $user->getParkingLike();

    // Décoder la chaîne JSON en un tableau PHP
    $parkingData = json_decode($parkingToAdd, true);

    // Extraire la valeur du tableau
    if (isset($parkingData['parking_like'])) {
        $parkingValue = $parkingData['parking_like'];

        // Vérifier si la valeur existe déjà dans l'array
        $index = array_search($parkingValue, $existingParking);
        if ($index !== false) {
            // Supprimer la valeur de l'array
            unset($existingParking[$index]);
        }else{
            // Ajouter la nouvelle valeur à l'array
            $existingParking[] = $parkingValue;
        }

        // Réaffecter le tableau mis à jour à la propriété parking_like de l'entité User
        $user->setParkingLike(array_values($existingParking));
    }

    $entityManager->flush();

    // Retourner la liste mise à jour des parkings likés en tant que JSON
    return new JsonResponse($existingParking);
}




}