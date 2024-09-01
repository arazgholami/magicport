<?php

namespace App\Repositories;

use App\Interfaces\ProjectRepositoryInterface;
use App\Models\Project;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ProjectRepository implements ProjectRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getAllProjects()
    {
        return Project::all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getProjectById($id)
    {
        return Project::findOrFail($id);
    }

    /**
     * @param $id
     * @return void
     */
    public function deleteProject($id)
    {
        Project::destroy($id);
    }

    /**
     * @param array $projectDetails
     * @return mixed
     */
    public function createProject(array $projectDetails)
    {
        return Project::create($projectDetails);
    }

    /**
     * @param $id
     * @param array $newDetails
     * @return mixed
     */
    public function updateProject($id, array $newDetails)
    {
        return Project::whereId($id)->update($newDetails);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getProjectTasks($id)
    {
        return Project::findOrFail($id)->tasks;
    }

    /**
     * @param string $search
     * @param array $filters
     * @return LengthAwarePaginator
     */
    public function searchProjects(string $search = '', array $filters = [])
    {
        return Project::query()
            ->when($search, function (Builder $query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->when(isset($filters['status']), function (Builder $query) use ($filters) {
                $query->whereHas('tasks', function (Builder $query) use ($filters) {
                    $query->where('status', $filters['status']);
                });
            })
            ->paginate(10);
    }
}
