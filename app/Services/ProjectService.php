<?php

namespace App\Services;

use App\Repositories\ProjectRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ProjectService
{
    /**
     * @var ProjectRepository
     */
    protected $projectRepository;

    /**
     * @param ProjectRepository $projectRepository
     */
    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    /**
     * @return Collection
     */
    public function getAllProjects()
    {
        return $this->projectRepository->getAllProjects();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function createProject(array $data)
    {
        return $this->projectRepository->createProject($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getProject($id)
    {
        return $this->projectRepository->getProjectById($id);
    }

    /**
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function updateProject($id, array $data)
    {
        return $this->projectRepository->updateProject($id, $data);
    }

    /**
     * @param $id
     * @return null
     */
    public function deleteProject($id)
    {
        return $this->projectRepository->deleteProject($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getProjectTasks($id)
    {
        return $this->projectRepository->getProjectTasks($id);
    }

    /**
     * @param string $search
     * @param array $filters
     * @return LengthAwarePaginator
     */
    public function searchProjects(string $search = '', array $filters = [])
    {
        return $this->projectRepository->searchProjects($search, $filters);
    }
}
