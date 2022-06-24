<?php
namespace App\Controller;

use Doctrine\ORM\EntityManager;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;


class validateEmailActions
{//     collectionOperations:[
//         'GET','POST',
//         'MAIL_VALIDATE'=>[
//             'METHOD' => 'PATCH',
//             'deserialize' => false,
//             'path' =>"user/validate/{token}",
//             'controller' => 'ValidateEmailActions'
//         ]
//     ]
// )]
    public function __construct(EntityManager $manager,Request $request,UserRepository $userRepository)
    {

    }
}