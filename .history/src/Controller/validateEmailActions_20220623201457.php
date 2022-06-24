<?php
namespace App\Controller;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;


class validateEmailActions
{
    public function __construct(EntityManager $manager,Request $request,UserRepository $userRepository)
    {

    }
}