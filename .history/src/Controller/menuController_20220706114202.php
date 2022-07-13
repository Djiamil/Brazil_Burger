<?php
namespace App\Controller;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\CreateBookPublication;

#[ApiResource(itemOperations: [
    'get',
    'post_publication' => [
        'method' => 'POST',
        'path' => '/books/{id}/publication',
        'controller' => CreateBookPublication::class,
    ],
])]
class menuController
{
    // ...
}