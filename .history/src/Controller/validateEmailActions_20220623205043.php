<?php
namespace App\Controller;


use Doctrine\ORM\EntityManager;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
        return new JsonResponse(['error'=>'Token not found'],Response::HTTP_BAD_REQUEST);
       }
       if($user->isIsEnable())
       {
        return new JsonResponse(['message'=>'Votre compt est deja creer'],Response::HTTP_BAD_REQUEST);

       }
       if($user->ex())
       {
        return new JsonResponse(['message'=>'Votre compt est deja creer'],Response::HTTP_BAD_REQUEST);

       }

    }
}