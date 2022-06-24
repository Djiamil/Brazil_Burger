<?php
namespace App\Controller;

use Doctrine\ORM\EntityManager;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;


class validateEmailActions
{
    public function __construct(EntityManager $manager)
    {

    }
    public function __invoke(EntityManager $manager,Request $request,UserRepository $userRepository)
    {
        $request->
    }
}