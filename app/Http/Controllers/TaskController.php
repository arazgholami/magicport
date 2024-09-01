<?php

namespace App\Http\Controllers;

use App\Services\ProjectService;
use App\Services\TaskService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * @var TaskService
     */
    protected $taskService;

    /**
     * @var ProjectService
     */
    protected $projectService;

    /**
     * @param TaskService $taskService
     * @param ProjectService $projectService
     */
    public function __construct(TaskService $taskService, ProjectService $projectService)
    {
        $this->taskService = $taskService;
        $this->projectService = $projectService;
    }

    /**
     * @param Request $request
     * @param $projectId
     * @return RedirectResponse
     */
    public function store(Request $request, $projectId)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'status' => 'required|in:todo,in-progress,done',
        ]);

        $validatedData['project_id'] = $projectId;
        $this->taskService->createTask($validatedData);
        return redirect()->route('projects.show', $projectId)->with('success', 'Task created successfully');
    }

    /**
     * @param Request $request
     * @param $projectId
     * @param $taskId
     * @return RedirectResponse
     */
    public function update(Request $request, $projectId, $taskId)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'status' => 'required|in:todo,in-progress,done',
        ]);

        $this->taskService->updateTask($taskId, $validatedData);
        return redirect()->route('projects.show', $projectId)->with('success', 'Task updated successfully');
    }

    /**
     * @param $projectId
     * @param $taskId
     * @return RedirectResponse
     */
    public function destroy($projectId, $taskId)
    {
        $this->taskService->deleteTask($taskId);
        return redirect()->route('projects.show', $projectId)->with('success', 'Task deleted successfully');
    }
}
