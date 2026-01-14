<?php

namespace App\Controller;

use App\Entity\Paragraphe;
use App\Entity\Project;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProjectController extends AbstractController
{
    #[Route('/project', name: 'project')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $projects = $entityManager->getRepository(Project::class)->findAll();
        return $this->render('project/index.html.twig', [
            'controller_name' => 'ProjectController',
            'projects'=>$projects
        ]);
    }
    #[Route('/project/{id}', name: 'project_id')]
    public function projectId(EntityManagerInterface $entityManager, int $id): Response
    {
        $project = $entityManager->getRepository(Project::class)->find($id);
        $paragraphes = $entityManager->getRepository(Paragraphe::class)->findBy(['id_project' => $id]);
        return $this->render('project/single.html.twig', [
            'controller_name' => 'ProjectController',
            'project'=>$project,
            'paragraphes'=>$paragraphes
        ]);
    }
}
