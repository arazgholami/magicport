<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\ProjectService;
use App\Services\TaskService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * @var ProjectService
     */
    protected $projectService;

    /**
     * @param ProjectService $projectService
     */
    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    /**
     * @param Request $request
     * @return Factory|View|Application
     */
    public function index(Request $request)
    {
        $search = $request->input('search') ?? '';
        $filters = $request->only(['status']) ?? [];
        $projects = $this->projectService->searchProjects($search, $filters);
        return view('projects.index', compact('projects', 'search', 'filters'));
    }

    /**
     * @return Factory|View|Application
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
        ]);

        $project = $this->projectService->createProject($validatedData);
        return redirect()->route('projects.show', $project->id)->with('success', 'Project created successfully');
    }

    /**
     * @param $id
     * @return Factory|View|Application
     */
    public function show($id)
    {
        $project = $this->projectService->getProject($id);
        $tasks = $this->projectService->getProjectTasks($id);
        return view('projects.show', compact('project', 'tasks'));
    }

    /**
     * @param $id
     * @return Factory|View|Application
     */
    public function edit($id)
    {
        $project = $this->projectService->getProject($id);
        return view('projects.edit', compact('project'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
        ]);

        $this->projectService->updateProject($id, $validatedData);
        return redirect()->route('projects.show', $id)->with('success', 'Project updated successfully');
    }

    public function destroy($id)
    {
        $this->projectService->deleteProject($id);
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully');
    }
}
