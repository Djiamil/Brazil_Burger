<?php

namespace App\Controller;

use App\Entity\Menu;
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
    $content = json_decode($request->getContent());
    if(!isset($content->burgers)){

            return  $this->json('Le menu doit contenir un burger',400);
        }


    
        dd("dd");

       $entityManager->persist($content);
       $entityManager->flush();
       return $this->json($content,201,[],['group'=>'menu:read']);
    }
}
// $menu = $serializer->deserialize($jsonrecu,Menu::class, 'json');
