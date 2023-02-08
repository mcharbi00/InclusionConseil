<?php

namespace App\Controller;

use App\Entity\Incluscore;
use App\Form\IncluscoreType;
use App\Repository\IncluscoreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/incluscore')]
class IncluscoreController extends AbstractController
{
    #[Route('/', name: 'app_incluscore_index', methods: ['GET'])]
    public function index(IncluscoreRepository $incluscoreRepository): Response
    {
        return $this->render('incluscore/index.html.twig', [
            'incluscores' => $incluscoreRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_incluscore_new', methods: ['GET', 'POST'])]
    public function new(Request $request, IncluscoreRepository $incluscoreRepository): Response
    {
        $incluscore = new Incluscore();
        $form = $this->createForm(IncluscoreType::class, $incluscore);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $incluscoreRepository->save($incluscore, true);

            return $this->redirectToRoute('app_incluscore_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('incluscore/new.html.twig', [
            'incluscore' => $incluscore,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_incluscore_show', methods: ['GET'])]
    public function show(Incluscore $incluscore): Response
    {
        return $this->render('incluscore/show.html.twig', [
            'incluscore' => $incluscore,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_incluscore_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Incluscore $incluscore, IncluscoreRepository $incluscoreRepository): Response
    {
        $form = $this->createForm(IncluscoreType::class, $incluscore);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $incluscoreRepository->save($incluscore, true);

            return $this->redirectToRoute('app_incluscore_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('incluscore/edit.html.twig', [
            'incluscore' => $incluscore,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/supprimer', name: 'app_incluscore_delete', methods: ['POST','GET'])]
    public function delete(int $id, EntityManagerInterface $entityManager): Response
    {
        $incluscore = $entityManager
        ->getRepository(Incluscore::class)
        ->find($id);
        $entityManager->remove($incluscore);
        $entityManager->flush();

        return $this->redirectToRoute('app_incluscore_index', [], Response::HTTP_SEE_OTHER);
    }
}
