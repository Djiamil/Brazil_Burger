<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\SerializerInterface;

class MenuController extends AbstractController
{
    public function __invoke(Request $request,SerializerInterface $serializer)
    {
        $jsonrecu  = $request->getContent();
        dd($jsonrecu);
    }
}
