<?php
namespace App\Controller;

use Symfony\Flex\Response;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ValidateEmailActions extends AbstractController
{

    public function __invoke(Request $request,UserRepository $userRepository)

    {
        $token = $request->get('token');
        $user = $userRepository->findOneBy(['token' => $token]);
        if ($user )
        {
            return new JsonResponse(['error' => 'Token not found'], Response::HTTP_BAD_REQUEST);
        }
        if
        {
            
        }
    }

}