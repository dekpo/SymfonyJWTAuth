<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class ApiController extends AbstractController
{
    public function __construct(TokenStorageInterface $tokenStorageInterface, JWTTokenManagerInterface $jwtManager)
    {
    $this->jwtManager = $jwtManager;
    $this->tokenStorageInterface = $tokenStorageInterface;
    }

    private $jwtManager;
    private $tokenStorageInterface;

    #[Route('/api', name: 'app_api')]
    public function index(): JsonResponse
    {
        $decodedJwtToken = $this->jwtManager->decode($this->tokenStorageInterface->getToken());
        /* return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]); */
        return new JsonResponse($decodedJwtToken,Response::HTTP_OK);
    }
}
