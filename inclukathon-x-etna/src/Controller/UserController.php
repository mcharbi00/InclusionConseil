<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{


    #[Route('/users', name: 'app_users')]
    public function getAll(EntityManagerInterface $em)
    {
        $users = $em->getRepository(User::class)->findAll();

        $data = array();
        foreach ($users as $user) {
            $data[] = array(
                'id' => $user->getId(),
                'firstname' => $user->getFirstName(),
                'lastname' => $user->getLastName(),
                'email' => $user->getEmail(),
                'isSuperAdmin' => $user->isSuperAdmin(),
            );
        }

        return new JsonResponse($data);
    }

    #[Route('/users/{id}', name: 'app_user')]
    public function getById($id, EntityManagerInterface $em)
    {
        $user = $em->getRepository(User::class)->find($id);

        if (!$user) {
            return new Response('Company not found', 404);
        }
        return new Response('User email: '.$user->getEmail());
    }
}
