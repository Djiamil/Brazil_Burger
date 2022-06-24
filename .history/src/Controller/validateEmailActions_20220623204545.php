<?php
namespace App\Controller;

use Doctrine\ORM\EntityManager;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;


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
        return new JsonResponse(['error'=>'Token not found'],Response);
       }
    }
}