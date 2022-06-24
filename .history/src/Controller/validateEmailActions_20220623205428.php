<?php
namespace App\Controller;


use Doctrine\ORM\EntityManager;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints\DateTime;


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
       if($user->getExpireAt()< new \DateTime())
       {
        return new JsonResponse(['message'=>'Votre token est expirer'],Response::HTTP_BAD_REQUEST);

       }

       $user-> setIsEnable(true);
       EntityManager

    }
}