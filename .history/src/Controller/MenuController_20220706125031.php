<?php

namespace App\Controller;

use Faker\Calculator\Ean;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MenuController extends AbstractController
{
    public function __invoke(Request $request,SerializerInterface $serializer,EntityManagerInterface $entityManager)
    {
        $jsonrecu  = $request->getContent();
        $post = $serializer->deserialize($jsonrecu,post::class, 'xml');
        $entityManager->persist($post);
        $entityManager->flush();
        dd($post);
        return $this->json($post,201,[],['group'=>'post:read']);
    }
}
