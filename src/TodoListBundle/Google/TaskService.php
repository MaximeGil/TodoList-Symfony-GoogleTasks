<?php

namespace TodoListBundle\Google;

use HappyR\Google\ApiBundle\Services\GoogleClient;
use Symfony\Component\Security\Core\SecurityContext;

class TaskService {

    private $service;

    public function __construct($client, $security) {
        $token = json_decode($security->getToken()->getUser(), true);
        $googleClient = $client->getGoogleClient();

        $googleClient->setAccessToken($token);

        $this->service = new \Google_Service_Tasks($googleClient);
    }

    public function deleteTaskFromList($taskList, $id) {
        $this->service->tasks->delete($taskList, $id);
    }

    public function addTask($taskList, $taskE) {
        $task = new \Google_Service_Tasks_Task();
        $task->setTitle($taskE['name']);
        $task->setNotes($taskE['note']);
        $task->setDue($taskE['datedue']->format(\DateTime::RFC3339));
        $task->setDeleted(false);
        $task->setHidden(false);
        $task->setParent($taskList);
        $date = new \DateTime();
        $date->format(\DateTime::RFC3339);
        $task->setUpdated($date);

        $this->service->tasks->insert($taskList, $task);
    }

    public function updateTask($taskList, $taskId, $taskC) {
        $task = new \Google_Service_Tasks_Task();
        $task->setId($taskId);
        $task->setTitle($taskC['name']);
        $task->setNotes($taskC['note']);
        $task->setDue($taskC['datedue']->format(\DateTime::RFC3339));
        $task->setDeleted(false);
        $task->setHidden(false);
        $task->setParent($taskList);

        $date->format(\DateTime::RFC3339);
        $task->setUpdated($date);

        $this->service->tasks->update($taskList, $taskId, $task);
    }

    public function setComplete($taskId, $taskList) {
        $task = new \Google_Service_Tasks_Task();
        $task->setParent($taskList);
        $task->setId($taskId);
        $date = new \DateTime();
        $date->format(\DateTime::RFC3339);
        $task->setUpdated($date);
        $task->setStatus('completed');

        $this->service->tasks->update($taskList, $taskId, $task);
    }

    public function setUncomplete($taskId, $taskList) {
        $task = new \Google_Service_Tasks_Task();
        $task->setParent($taskList);
        $task->setId($taskId);
        $date = new \DateTime();
        $date->format(\DateTime::RFC3339);
        $task->setUpdated($date);
        $task->setStatus('needsAction');

        $this->service->tasks->update($taskList, $taskId, $task);
    }

}
