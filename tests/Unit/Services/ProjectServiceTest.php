<?php

use App\Models\Project;
use App\Models\Task;
use App\Services\ProjectService;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(Tests\TestCase::class, RefreshDatabase::class);

beforeEach(function () {
    $this->projectService = app(ProjectService::class);
});

it('can create a project via service', function () {
    $data = [
        'name' => 'Service Project',
        'description' => 'Service Description',
    ];

    $project = $this->projectService->createProject($data);

    expect($project)->toBeInstanceOf(Project::class);
    expect($project->name)->toBe('Service Project');
    expect($project->description)->toBe('Service Description');
    $this->assertDatabaseHas('projects', ['name' => 'Service Project']);
});

it('can update a project via service', function () {
    $project = Project::factory()->create();

    $updatedProject = $this->projectService->updateProject($project->id, [
        'name' => 'Updated Service Project',
        'description' => 'Updated Service Description',
    ]);

    expect($updatedProject)->toBe(1);
    $this->assertDatabaseHas('projects', ['name' => 'Updated Service Project']);
});

it('can delete a project via service', function () {
    $project = Project::factory()->create();

    $this->projectService->deleteProject($project->id);

    $this->assertDatabaseMissing('projects', ['id' => $project->id]);
});

it('can retrieve project tasks via service', function () {
    $project = Project::factory()->create();
    Task::factory()->count(5)->create(['project_id' => $project->id]);

    $tasks = $this->projectService->getProjectTasks($project->id);

    expect($tasks)->toHaveCount(5);
    expect($tasks->first())->toBeInstanceOf(\App\Models\Task::class);
});
