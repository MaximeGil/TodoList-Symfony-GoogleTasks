<?php

namespace TodoListBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Authentication\Token\PreAuthenticatedToken;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\User;
use TodoListBundle\Form\TaskForm;

class TaskController extends Controller {

    public function deleteTaskAction($taskList, $id) {
        $listService = $this->get('todo_list.google.listservice');
        $taskService = $this->get('todo_list.google.taskservice');
        $taskService->deleteTaskFromList($taskList, $id);
        $tasks = $listService->getTasksFromList($taskList);

        return $this->render('TodoListBundle:Default:items.html.twig', array('tasks' => $tasks, 'taskList' => $taskList));
    }

    public function addAction($taskList, Request $request) {
        $taskService = $this->get('todo_list.google.taskservice');
        $taskForm = new TaskForm();
        $form = $taskForm->createAddForm();

        if ($request->isMethod('POST')) {
            $form->submit($request->request->get($form->getName()));

            if ($form->isValid()) {
                $data = $form->getData();
                $taskService->addTask($taskList, $data);
            }
        }

        return $this->render('TodoListBundle:Default:addtask.html.twig', array('form' => $form->createView()));
    }

    public function updateTaskAction($task, $taskList, Request $request) {
        $taskService = $this->get('todo_list.google.taskservice');
        $taskForm = new TaskForm();
        $form = $taskForm->createUpdateForm();

        if ($request->isMethod('POST')) {
            $form->submit($request->request->get($form->getName()));

            if ($form->isValid()) {
                $data = $form->getData();
                $taskService->updateTask($taskList, $task, $data);
            }
        }

        return $this->render('TodoListBundle:Default:updatetask.html.twig', array('form' => $form->createView()));
    }

    public function completeTaskAction($taskId, $taskList, Request $request) {
        $taskService = $this->get('todo_list.google.taskservice');
        $taskService->setComplete($taskId, $taskList);

        return $this->redirectToRoute('todo_list_list');
    }

    public function uncompleteTaskAction($taskId, $taskList, Request $request) {
        $taskService = $this->get('todo_list.google.taskservice');
        $taskService->setUncomplete($taskId, $taskList);

        return $this->redirectToRoute('todo_list_list');
    }

}
