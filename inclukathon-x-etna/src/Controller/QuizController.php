<?php

namespace App\Controller;

use App\Entity\Incluscore;
use App\Repository\IncluscoreRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ThemesIncluscoreRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class QuizController extends AbstractController
{
    #[Route('/quiz', name: 'app_quiz')]
    public function index(IncluscoreRepository $incluscoreRepository): Response
    {
        return $this->render('quiz/index.html.twig', [
            'incluscores' => $incluscoreRepository->findAll(),
        ]);
    }
    #[Route('/{id}/incluscore', name: 'app_incluscore')]
    public function incluscore(int $id,EntityManagerInterface $entityManager): Response
    {
        $incluscore = $entityManager
        ->getRepository(Incluscore::class)
        ->find($id);
        return $this->render('quiz/incluscore.html.twig', [
            'incluscore' => $incluscore,
        ]);
    }
    #[Route('/{id}/themes', name: 'app_themes')]
    public function themes(int $id,ThemesIncluscoreRepository $themesIncluscoreRepository): Response
    {
        $themes = $themesIncluscoreRepository->findBy(array('incluscore' => $id));
        return $this->render('quiz/themes.html.twig', [
            'themes' => $themes,
        ]);
    }
}
