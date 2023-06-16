<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetMailController
{
    #[Route('/api/users/{id}/mail', name: 'api_mail', methods: ['GET'])]
    public function getUserMail(User $user): Response
    {
        $mail = $user->getMail();

        return new Response($mail);
    }
}