<?php

namespace App\Services;

use App\Repositories\TaskRepository;

class TaskService
{
    /**
     * @var TaskRepository
     */
    protected $taskRepository;

    /**
     * @param TaskRepository $taskRepository
     */
    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function createTask(array $data)
    {
        return $this->taskRepository->createTask($data);
    }

    /**
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function updateTask($id, array $data)
    {
        return $this->taskRepository->updateTask($id, $data);
    }

    /**
     * @param $id
     * @return null
     */
    public function deleteTask($id)
    {
        return $this->taskRepository->deleteTask($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getTaskById($id)
    {
        return $this->taskRepository->getTaskById($id);
    }
}
