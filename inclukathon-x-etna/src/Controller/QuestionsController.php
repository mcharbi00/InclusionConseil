<?php

namespace App\Controller;

use App\Entity\Questions;
use App\Form\QuestionsType;
use App\Entity\ThemesIncluscore;
use App\Repository\QuestionsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/questions')]
class QuestionsController extends AbstractController
{
    #[Route('/{idTheme}', name: 'app_questions_index', methods: ['GET'])]
    public function index(int $idTheme,QuestionsRepository $questionsRepository): Response
    {
        return $this->render('questions/index.html.twig', [
            'questions' => $questionsRepository->findBy(array(
                'themeIncluscore' => $idTheme,
        )),
            'id' => $idTheme
        ]);
    }

    #[Route('/{id}/new', name: 'app_questions_new', methods: ['GET', 'POST'])]
    public function new(int $id,Request $request, QuestionsRepository $questionsRepository, EntityManagerInterface $entityManager): Response
    {
        $question = new Questions();
        $form = $this->createForm(QuestionsType::class, $question);
        $form->handleRequest($request);
        $theme = $entityManager
            ->getRepository(ThemesIncluscore::class)
            ->find($id);
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('PathMedia')->getData();
                
                if ($file != null) {
                date_default_timezone_set('Europe/Paris');
                $date = date('dmyhi');

                    $FileName = $form->get('question')->getData().'-'.$date.'.'.$file->guessExtension();
                    try {
                        $file->move(
                            $this->getParameter('upload_directory_question'),
                            $FileName
                        );
                    } catch (FileException $e) {
                        // ... handle exception if something happens during file upload
                    }
                    $question->setPathMedia ($FileName);
                }
            $question->setThemeIncluscore($theme);
            $questionsRepository->save($question, true);

            return $this->redirectToRoute('app_questions_index', array(
                'idTheme' => $id,
        ));
        }

        return $this->renderForm('questions/new.html.twig', [
            'question' => $question,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_questions_show', methods: ['GET'])]
    public function show(Questions $question): Response
    {
        return $this->render('questions/show.html.twig', [
            'question' => $question,
        ]);
    }

    #[Route('/{idTheme}/{id}/edit', name: 'app_questions_edit', methods: ['GET', 'POST'])]
    public function edit(int $idTheme,Request $request, Questions $question, QuestionsRepository $questionsRepository): Response
    {
        $form = $this->createForm(QuestionsType::class, $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('PathMedia')->getData();
                
                if ($file != null) {
                date_default_timezone_set('Europe/Paris');
                $date = date('dmyhi');

                    $FileName = $form->get('question')->getData().'-'.$date.'.'.$file->guessExtension();
                    try {
                        $file->move(
                            $this->getParameter('upload_directory_question'),
                            $FileName
                        );
                    } catch (FileException $e) {
                        // ... handle exception if something happens during file upload
                    }
                    $question->setPathMedia ($FileName);
                }
            $questionsRepository->save($question, true);

            return $this->redirectToRoute('app_questions_index', array(
                'idTheme' => $idTheme,
        ));
        }

        return $this->renderForm('questions/edit.html.twig', [
            'question' => $question,
            'form' => $form,
        ]);
    }

    #[Route('/{idTheme}/{id}/delete', name: 'app_questions_delete', methods: ['POST','GET'])]
    public function delete(int $id,int $idTheme, EntityManagerInterface $entityManager): Response
    {
        $question = $entityManager
        ->getRepository(Questions::class)
        ->find($id);
        $entityManager->remove($question);
        $entityManager->flush();

        return $this->redirectToRoute('app_questions_index', array(
            'idTheme' => $idTheme,
    ));
    }
}
