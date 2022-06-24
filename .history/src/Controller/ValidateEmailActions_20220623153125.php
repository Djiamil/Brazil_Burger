<?php
namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ValidateEmailActions extends AbstractController
{

    public function __invoke(Request $request,UserRepository $userRepository)

    {
        $token = $request->get('token');
        $user = $userRepository->findOneBy(['token' => $token]);
        if ($user )
        {
            return new JsonResponse
        }
    }

}