<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TaskController extends AbstractController
{
    #[Route('/task', name: 'app_task')]
    public function index(): Response
    {
        return $this->render('task/index.html.twig', [
            'controller_name' => 'TaskController',
        ]);
    }
    
    #[Route('/new', name:'app_task_new')]
    public function new(): Response
    {
       
    }
    #[Route('/edit/{id}', name:'app_task_edit')]
    public function update(): Response
    {
       
    }
}
