<?php

namespace TodoListBundle\Google;

use HappyR\Google\ApiBundle\Services\GoogleClient;
use Symfony\Component\Security\Core\SecurityContext;
use Google_Service_Tasks_TaskList;

class ListService {

    private $service;

    public function __construct($client, $security) {
        $token = json_decode($security->getToken()->getUser(), true);
        $googleClient = $client->getGoogleClient();

        $googleClient->setAccessToken($token);

        $this->service = new \Google_Service_Tasks($googleClient);
    }

    public function getTaskLists() {
        return $this->service->tasklists->listTasklists()->getItems();
    }
    
    public function updateTaskList($taskList, $name)
    {
       $taskListC = $this->service->tasklists->get($taskList);
       $taskListC->setTitle($name);
       
       $this->service->tasklists->update($taskList, $taskListC);
       
    }
    
    public function getTasksFromList($taskList) {
        return $this->service->tasks->listTasks($taskList);
    }

    public function deleteTasksList($taskList) {
        $this->service->tasklists->delete($taskList);
    }

    public function createTaskList($name) {
        $taskList = new \Google_Service_Tasks_TaskList();
        $taskList->setKind('tasks#taskList');
        $taskList->setTitle($name);
        $date = new \DateTime();
        $date->format(\DateTime::RFC3339);
        $taskList->setUpdated($date);

        $this->service->tasklists->insert($taskList);
    }

}
