<?php

namespace App\Controller;

use App\Entity\Teams;
use App\Entity\Companies;
use App\Form\TeamFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TeamsController extends AbstractController
{


    #[Route('/teams', name: 'app_teams')]
    public function getAll(EntityManagerInterface $em)
    {
        $teams = $em->getRepository(Teams::class)->findAll();

        $data = array();
        foreach ($teams as $team) {
            $data[] = array(
                'id' => $team->getId(),
                'name' => $team->getName(),
                'enabled' => $team->isEnabled(),
                'description' => $team->getProjectDescription(),
            );
        }

        return new JsonResponse($data);
    }

    #[Route('/teams/{id}', name: 'app_team')]
    public function getById($id, EntityManagerInterface $em)
    {
        $team = $em->getRepository(Teams::class)->find($id);

        if (!$team) {
            return new Response('Team not found', 404);
        }
        return new Response('Team name: '.$team->getName());
    }


    #[Route('/add-team/{id}', name: 'app_add_team')]
    public function addTeam($id, EntityManagerInterface $em, Request $request)
    {
        $company = $em->getRepository(Companies::class)->find($id);
        $team = new Teams();
        $form = $this->createForm(TeamFormType::class, $team);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $team->setCompanies($company);
            $em->persist($team);
            $em->flush();
            return $this->redirectToRoute('app_teams_by_company', ['id' => $id]);
        }

        return $this->render('teams/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/edit-team/{id}', name: 'app_team_edit')]
    public function editTeam(Request $request, EntityManagerInterface $em, $id)
    {
        $team = $em->getRepository(Teams::class)->find($id);
        $company = $team->getCompanies();

        if (!$team) {
            throw $this->createNotFoundException(sprintf('Team with id %s not found', $id));
        }
    
        $form = $this->createForm(TeamFormType::class, $team);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
    
            return $this->redirectToRoute('app_teams_by_company' , ['id' => $team->getCompanies()->getId()]);
        }
    
        return $this->render('teams/edit.html.twig', [
            'form' => $form->createView(),
            'team' => $team,
            'company' => $company
        ]);
    }
}

