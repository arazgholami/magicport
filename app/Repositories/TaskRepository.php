<?php

namespace App\Repositories;

use App\Interfaces\TaskRepositoryInterface;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class TaskRepository implements TaskRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getAllTasks()
    {
        return Task::all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getTaskById($id)
    {
        return Task::findOrFail($id);
    }

    /**
     * @param $id
     * @return void
     */
    public function deleteTask($id)
    {
        Task::destroy($id);
    }

    /**
     * @param array $taskDetails
     * @return mixed
     */
    public function createTask(array $taskDetails)
    {
        return Task::create($taskDetails);
    }

    /**
     * @param $id
     * @param array $newDetails
     * @return mixed
     */
    public function updateTask($id, array $newDetails)
    {
        return Task::whereId($id)->update($newDetails);
    }
}
