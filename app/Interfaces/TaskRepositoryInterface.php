<?php

namespace App\Interfaces;

interface TaskRepositoryInterface
{
    public function getAllTasks();

    public function getTaskById($id);

    public function deleteTask($id);

    public function createTask(array $taskDetails);

    public function updateTask($id, array $newDetails);
}
