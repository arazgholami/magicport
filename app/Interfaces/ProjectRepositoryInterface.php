<?php

namespace App\Interfaces;

interface ProjectRepositoryInterface
{
    public function getAllProjects();
    public function getProjectById($id);
    public function deleteProject($id);
    public function createProject(array $projectDetails);
    public function updateProject($id, array $newDetails);
    public function getProjectTasks($id);
    public function searchProjects(string $search, array $filters);
}
