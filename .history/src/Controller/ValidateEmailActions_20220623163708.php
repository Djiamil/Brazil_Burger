<?php
// namespace App\Controller;

// use Symfony\Flex\Response;
// use App\Repository\UserRepository;
// use Doctrine\ORM\EntityManagerInterface;
// use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\HttpFoundation\JsonResponse;
// use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

// class ValidateEmailActions extends AbstractController
// {

//     public function __invoke(Request $request,UserRepository $userRepository,EntityManagerInterface $entityManager)

//     {
//         $token = $request->get('token');
//         $user = $userRepository->findOneBy(['token' => $token]);
//         if ($user )
//         {
//             return new JsonResponse(['error' => 'Token non valide'], Response::HTTP_BAD_REQUEST);
//         }
//         if($user -> isIsActive())
//         {
//             return new JsonResponse(['message' => 'Le compte est deja activé'], Response::HTTP_BAD_REQUEST);

//         }
//         if($user -> isIsExpired())
//         {
//             return new JsonResponse(['message' => 'clé expirer'], Response::HTTP_BAD_REQUEST);

//         }
//         $user-> setIsActivate(true);

//         $entityManager->flush();
//         return new JsonResponse(['success' => 'clé expirer'], Response::HTTP_BAD_REQUEST);

        
//     }

}