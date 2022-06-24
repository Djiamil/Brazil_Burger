<?php
namespace App\Controller;

use Symfony\Flex\Response;
use Doctrine\ORM\EntityManager;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\HTTP_BAD_REQUEST;


class validateEmailActions
{
    public function __construct(EntityManager $manager)
    {

    }
    public function __invoke(EntityManager $manager,Request $request,UserRepository $userRepository)
    {
       $token = $request->get('token');
       $user = $userRepository ->findOneBy(['token'=>$token]);
       if(!$user){
        return new JsonResponse(['error'=>'Token not found'],Response::HTTP_BAD_REQUEST);
       }
    }
}