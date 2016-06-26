<?php

namespace TodoListBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Authentication\Token\PreAuthenticatedToken;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\User;
use TodoListBundle\Form\ListForm;

class ListController extends Controller {

    public function listAction() {
        $listService = $this->get('todo_list.google.listservice');
        $taskLists = $listService->getTaskLists();

        return $this->render('TodoListBundle:Default:index.html.twig', array('taskLists' => $taskLists));
    }

    public function deleteAction($taskList) {
        $listService = $this->get('todo_list.google.listservice');
        $listService->deleteTasksList($taskList);
        return $this->redirectToRoute('todo_list_list');
    }

    public function updateAction($taskList, Request $request) {
        $listService = $this->get('todo_list.google.listservice');
        $listForm = new ListForm();
        $form = $listForm->createAddForm();

        if ($request->isMethod('POST')) {
            $form->submit($request->request->get($form->getName()));

            if ($form->isValid()) {
                $data = $form->getData();
                $listService->updateTaskList($taskList, $data['name']);
            }
        }
        return $this->render('TodoListBundle:Default:updatelist.html.twig', array('form' => $form->createView()));
    }

    public function showItemsAction($taskList) {
        $listService = $this->get('todo_list.google.listservice');
        $tasks = $listService->getTasksFromList($taskList);

        return $this->render('TodoListBundle:Default:items.html.twig', array('tasks' => $tasks, 'taskList' => $taskList));
    }

    public function addAction(Request $request) {
        $listService = $this->get('todo_list.google.listservice');
        $listForm = new ListForm();
        $form = $listForm->createAddForm();

        if ($request->isMethod('POST')) {
            $form->submit($request->request->get($form->getName()));

            if ($form->isValid()) {
                $data = $form->getData();
                $listService->createTaskList($data['name']);
            }
        }

        return $this->render('TodoListBundle:Default:addlist.html.twig', array('form' => $form->createView()));
    }

}
