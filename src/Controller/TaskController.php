<?php

namespace App\Controller;

use App\Entity\Task;
use App\form\TaskType;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TaskController extends AbstractController
{
    #[Route('/task', name: 'app_task_index', methods: ['GET'])]
    public function index(TaskRepository $taskRepository): Response 
    {
        
        return $this->render('task/index.html.twig', [
           'tasks'=>$taskRepository->findAll()
        ]);
    }
    
    #[Route('task/new', name:'app_new_task', methods: ['GET','POST'])]
    public function new(EntityManagerInterface $entityManagerInterface, Request $request): Response
    {

        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

      

        if ($form->isSubmitted() && $form->isValid()) {
        
        $entityManagerInterface->persist($task);
        $entityManagerInterface->flush();
        
        // $this->addFlash('success','une nouvelle tâche a été ajoutée avec succès');
    }
        return $this->render('task/index.html.twig',[
        'task' => $task,
        'form' => $form
            
        ]);
    

    
    }
    #[Route('task/{id}/edit', name:'app_edit_task', methods: ['GET', 'POST'])]
    public function edit(Task $task, Request $request, EntityManagerInterface $entityManagerInterface, TaskRepository $taskRepository): Response
    {
   

        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           
            $entityManagerInterface->flush();
     }
        return $this->render('task/edit.html.twig',[
        'task' => $task,
        'form' => $form
        ]);  
    }
}