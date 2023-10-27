<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[RouteController]
class RegisterController extends AbstractController
{
    private $entityManager;
    private $passwordEncoder;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher)
    {
        $this->entityManager = $entityManager;
        $this->passwordHasher = $passwordHasher;
    }    

    #[Route('/api/register', name: 'api_register', methods: ['POST'])]
    public function register(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $email = $data['email'];
        $password = $data['password'];

        $user = new User();
        $user->setMail($email);

        $hashedPassword = hash('sha512', $password);
        $user->setPassword($hashedPassword);

        $this->entityManager->persist($user);
        // Generate token
        $token = base64_encode(random_bytes(32));

        // Set token to user
        $user->setToken($token);

        $user->setCodeVerif(str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT));


        // mettre l'envoie d'email


        $this->entityManager->flush();


        return new Response('User registered successfully!', Response::HTTP_CREATED);
    }
}
