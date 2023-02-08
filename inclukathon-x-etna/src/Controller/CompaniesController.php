<?php

namespace App\Controller;

use App\Entity\Teams;
use App\Entity\Companies;
use App\Form\TeamFormType;
use App\Form\CompanyFormType;
use App\Services\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class CompaniesController extends AbstractController
{

    #[Route('/companies', name: 'app_companies')]
    public function getAll(EntityManagerInterface $em)
    {
        $companies = $em->getRepository(Companies::class)->findAll();
        $data = array();
        foreach ($companies as $company) {
            $users = array();
            $teams = array();
            $inclus = array();
            foreach ($company->getUsers() as $user) {
                $users[] = array(
                    'firstname' => $user->getFirstName()
                );
            }
            foreach ($company->getTeams() as $team) {
                $teams[] = array(
                    'name' => $team->getName()
                );
            }
            foreach ($company->getIncluscores() as $inclu) {
                $inclus[] = array(
                    'name' => $inclu->getName()
                );
            }
            $data[] = array(
                'id' => $company->getId(),
                'name' => $company->getName(),
                'imgPath' => $company->getImgPath(),
                'users' => $users,
                'teams' => $teams,
                'incluscores' => $inclus
            );
        }
        //dd($data);
        return $this->render('companies/index.html.twig', [
            'companies' => $data,   
        ]);
    }


    


    // #[Route('/companies/{id}', name: 'app_company')]
    // public function getById($id, EntityManagerInterface $em)
    // {
    //     $company = $em->getRepository(Companies::class)->find($id);

    //     if (!$company) {
    //         return new Response('Company not found', 404);
    //     }
    //     return $this->render('companies/show.html.twig', [
    //         'company' => $company,
    //         'users' => $company->getUsers(),
    //         'teams' => $company->getTeams(),
    //     ]);
    // }

    #[Route('/add-company', name: 'app_add_company')]
    public function addCompany(EntityManagerInterface $em, Request $request)
{
    $company = new Companies();
    $form = $this->createForm(CompanyFormType::class, $company);
    $form->handleRequest($request);
    $imgdir = '../../public/img/companies';

    if ($form->isSubmitted() && $form->isValid()) {
        $imgPath = $form->get('imgPath')->getData();
        if ($imgPath) {
            $originalFilename = pathinfo($imgPath->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$imgPath->guessExtension();
            try {
                $imgPath->move(
                    $this->getParameter('img_directory'),
                    $newFilename
                );
            } catch (FileException $e) {
                return $this->render('companies/add.html.twig', [
                    'form' => $form->createView(),
                    'error' => $e->getMessage()
                ]);
            }
            $company->setImgPath($newFilename);
        }
        $em->persist($company);
        $em->flush();
        return $this->redirectToRoute('app_companies');
    }

    return $this->render('companies/add.html.twig', [
        'form' => $form->createView()
    ]);
}



#[Route('/edit-company/{id}', name: 'app_company_edit')]
public function editCompany(Companies $company, Request $request, EntityManagerInterface $em)
{
    $form = $this->createForm(CompanyFormType::class, $company);
    $form->handleRequest($request);

    $imgPath = $form->get('imgPath')->getData();
        if ($imgPath) {
            $originalFilename = pathinfo($imgPath->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$imgPath->guessExtension();
            try {
                $imgPath->move(
                    $this->getParameter('img_directory'),
                    $newFilename
                );
            } catch (FileException $e) {
                    return $this->render('companies/add.html.twig', [
                        'form' => $form->createView(),
                        'error' => $e->getMessage()
                    ]);
                }
                $company->setImgPath($newFilename);
                $em->persist($company);
        $em->flush();
        return $this->redirectToRoute('app_companies');
    }

    return $this->render('companies/edit.html.twig', [
        'form' => $form->createView(),
        'company' => $company
    ]);
}

    #[Route('/companies/{id}/teams', name: 'app_teams_by_company')]
    public function showTeamsByCompanyId($id, EntityManagerInterface $em)
    {
        $company = $em->getRepository(Companies::class)->find($id);
        if (!$company) {   
            throw $this->createNotFoundException(
            'No company found for id '.$id
            );
        }
        foreach ($company->getTeams() as $team) {
            $teams[] = array(
                'id' => $team->getId(),
                'name' => $team->getName(),
                'project_description' => $team->getProjectDescription(),
            );}
        return $this->render('companies/teams.html.twig', [
            'company' => $company,
            'teams' => $teams,
        ]);
    }

    #[Route('/companies/{id}/incluscores', name: 'app_incluscores_by_company')]
    public function showIncluscoresByCompanyId($id, EntityManagerInterface $em)
    {
        $company = $em->getRepository(Companies::class)->find($id);
        if (!$company) {   
            throw $this->createNotFoundException(
            'No company found for id '.$id
            );
        }
        foreach ($company->getIncluscores() as $inclu) {
            $inclus[] = array(
                'id' => $inclu->getId(),
                'name' => $inclu->getName(),
                'description' => $inclu->getDescription(),
                'quizzLink' => $inclu->getQuizzLink(),

            );}
        return $this->render('companies/incluscores.html.twig', [
            'company' => $company,
            'inclus' => $inclus,
        ]);
    }

}
