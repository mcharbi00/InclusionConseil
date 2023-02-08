<?php

namespace App\Controller;

use App\Entity\Incluscore;
use App\Entity\ThemesIncluscore;
use App\Form\ThemesIncluscoreType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ThemesIncluscoreRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/themes/incluscore')]
class ThemesIncluscoreController extends AbstractController
{
    #[Route('/{idIncluscore}', name: 'app_themes_incluscore_index', methods: ['GET'])]
    public function index(int $idIncluscore,ThemesIncluscoreRepository $themesIncluscoreRepository): Response
    {

        return $this->render('themes_incluscore/index.html.twig', [
            'themes_incluscores' => $themesIncluscoreRepository->findBy(array(
                'incluscore' => $idIncluscore,
        )),
            'idIncluscore' => $idIncluscore
        ]);
    }

    #[Route('/{id}/new', name: 'app_themes_incluscore_new', methods: ['GET', 'POST'])]
    public function new(int $id,Request $request, ThemesIncluscoreRepository $themesIncluscoreRepository, EntityManagerInterface $entityManager): Response
    {
        $themesIncluscore = new ThemesIncluscore();
        $form = $this->createForm(ThemesIncluscoreType::class, $themesIncluscore);
        $form->handleRequest($request);
        $incluscore = $entityManager
            ->getRepository(Incluscore::class)
            ->find($id);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('imgPath')->getData();
                
                if ($file != null) {
                date_default_timezone_set('Europe/Paris');
                $date = date('dmyhi');

                    $FileName = $form->get('name')->getData().'-'.$date.'.'.$file->guessExtension();
                    try {
                        $file->move(
                            $this->getParameter('upload_directory_img_theme'),
                            $FileName
                        );
                    } catch (FileException $e) {
                        // ... handle exception if something happens during file upload
                    }
                    $themesIncluscore->setImgPath($FileName);
                }
                
            $themesIncluscore->setIncluscore($incluscore);
            $themesIncluscoreRepository->save($themesIncluscore, true);
            return $this->redirectToRoute('app_themes_incluscore_index', array(
                'idIncluscore' => $id,
        ));
        }

        return $this->renderForm('themes_incluscore/new.html.twig', [
            'themes_incluscore' => $themesIncluscore,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_themes_incluscore_show', methods: ['GET'])]
    public function show(ThemesIncluscore $themesIncluscore): Response
    {
        return $this->render('themes_incluscore/show.html.twig', [
            'themes_incluscore' => $themesIncluscore,
        ]);
    }

    #[Route('/{idIclu}/{id}/edit', name: 'app_themes_incluscore_edit', methods: ['GET', 'POST'])]
    public function edit(int $id,int $idIclu,Request $request, ThemesIncluscore $themesIncluscore, ThemesIncluscoreRepository $themesIncluscoreRepository): Response
    {
        $form = $this->createForm(ThemesIncluscoreType::class, $themesIncluscore);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('imgPath')->getData();
                
                if ($file != null) {
                date_default_timezone_set('Europe/Paris');
                $date = date('dmyhi');

                    $FileName = $form->get('name')->getData().'-'.$date.'.'.$file->guessExtension();
                    try {
                        $file->move(
                            $this->getParameter('upload_directory_img_theme'),
                            $FileName
                        );
                    } catch (FileException $e) {
                        // ... handle exception if something happens during file upload
                    }
                    $themesIncluscore->setImgPath($FileName);
                }
            $themesIncluscoreRepository->save($themesIncluscore, true);

            return $this->redirectToRoute('app_themes_incluscore_index', array(
                'idIncluscore' => $idIclu,
        ));
        }

        return $this->renderForm('themes_incluscore/edit.html.twig', [
            'themes_incluscore' => $themesIncluscore,
            'form' => $form,
        ]);
    }

    #[Route('/{idIclu}/{id}/delete', name: 'app_themes_incluscore_delete', methods: ['POST','GET'])]
    public function delete(int $id,int $idIclu, EntityManagerInterface $entityManager): Response
    {
        $theme = $entityManager
        ->getRepository(ThemesIncluscore::class)
        ->find($id);
        $entityManager->remove($theme);
        $entityManager->flush();

        return $this->redirectToRoute('app_themes_incluscore_index', array(
            'idIncluscore' => $idIclu));
    }
}
