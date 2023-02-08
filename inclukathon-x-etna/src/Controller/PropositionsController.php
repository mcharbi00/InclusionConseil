<?php

namespace App\Controller;

use App\Entity\Questions;
use App\Entity\Propositions;
use App\Form\PropositionsType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\PropositionsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/propositions')]
class PropositionsController extends AbstractController
{
    #[Route('/{idQuestion}', name: 'app_propositions_index', methods: ['GET'])]
    public function index(int $idQuestion,PropositionsRepository $propositionsRepository): Response
    {
        return $this->render('propositions/index.html.twig', [
            'propositions' => $propositionsRepository->findBy(array(
                'question' => $idQuestion,
        )),
            'id' => $idQuestion
        ]);
    }

    #[Route('/{id}/new', name: 'app_propositions_new', methods: ['GET', 'POST'])]
    public function new(int $id,Request $request, PropositionsRepository $propositionsRepository, EntityManagerInterface $entityManager): Response
    {
        $proposition = new Propositions();
        $form = $this->createForm(PropositionsType::class, $proposition);
        $form->handleRequest($request);
        $question = $entityManager
            ->getRepository(Questions::class)
            ->find($id);
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('propMedia')->getData();
                
                if ($file != null) {
                date_default_timezone_set('Europe/Paris');
                $date = date('dmyhi');

                    $FileName = $form->get('type')->getData().'-'.$date.'.'.$file->guessExtension();
                    try {
                        $file->move(
                            $this->getParameter('upload_directory_prop'),
                            $FileName
                        );
                    } catch (FileException $e) {
                        // ... handle exception if something happens during file upload
                    }
                    $proposition->setPropMedia($FileName);
                }
            $proposition->setQuestion($question);
            $propositionsRepository->save($proposition, true);

            return $this->redirectToRoute('app_propositions_index', array(
                'idQuestion' => $id,
        ));
        }

        return $this->renderForm('propositions/new.html.twig', [
            'proposition' => $proposition,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_propositions_show', methods: ['GET'])]
    public function show(Propositions $proposition): Response
    {
        return $this->render('propositions/show.html.twig', [
            'proposition' => $proposition,
        ]);
    }

    #[Route('/{idQuestion}/{id}/edit', name: 'app_propositions_edit', methods: ['GET', 'POST'])]
    public function edit(int $idQuestion,Request $request, Propositions $proposition, PropositionsRepository $propositionsRepository): Response
    {
        $form = $this->createForm(PropositionsType::class, $proposition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('propMedia')->getData();
                
                if ($file != null) {
                date_default_timezone_set('Europe/Paris');
                $date = date('dmyhi');

                    $FileName = $form->get('type')->getData().'-'.$date.'.'.$file->guessExtension();
                    try {
                        $file->move(
                            $this->getParameter('upload_directory_prop'),
                            $FileName
                        );
                    } catch (FileException $e) {
                        // ... handle exception if something happens during file upload
                    }
                    $proposition->setPropMedia($FileName);
                }
            $propositionsRepository->save($proposition, true);

            return $this->redirectToRoute('app_propositions_index', array(
                'idQuestion' => $idQuestion,
        ));
        }

        return $this->renderForm('propositions/edit.html.twig', [
            'proposition' => $proposition,
            'form' => $form,
        ]);
    }

    #[Route('/{idQuestion}/{id}', name: 'app_propositions_delete', methods: ['POST','GET'])]
    public function delete(int $idQuestion,int $id, EntityManagerInterface $entityManager): Response
    {
        $proposition = $entityManager
        ->getRepository(Propositions::class)
        ->find($id);
        $entityManager->remove($proposition);
        $entityManager->flush();
        return $this->redirectToRoute('app_propositions_index', array(
            'idQuestion' => $idQuestion,
    ));
    }
}
