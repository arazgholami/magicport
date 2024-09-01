<?php

use App\Models\Project;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(Tests\TestCase::class, RefreshDatabase::class);

beforeEach(function () {
    $this->taskService = app(TaskService::class);
    $this->project = Project::factory()->create();
});

it('can create a task via service', function () {
    $data = [
        'project_id' => $this->project->id,
        'name' => 'Service Task',
        'description' => 'Service Task Description',
        'status' => 'todo',
    ];

    $task = $this->taskService->createTask($data);

    expect($task)->toBeInstanceOf(Task::class);
    expect($task->name)->toBe('Service Task');
    $this->assertDatabaseHas('tasks', ['name' => 'Service Task']);
});

it('can update a task via service', function () {
    $task = Task::factory()->create(['project_id' => $this->project->id]);

    $updatedTask = $this->taskService->updateTask($task->id, [
        'name' => 'Updated Service Task',
        'description' => 'Updated Service Task Description',
        'status' => 'done',
    ]);

    expect($updatedTask)->toBe(1);
    $this->assertDatabaseHas('tasks', ['name' => 'Updated Service Task', 'status' => 'done']);
});

it('can delete a task via service', function () {
    $task = Task::factory()->create(['project_id' => $this->project->id]);

    $this->taskService->deleteTask($task->id);

    $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
});

it('can retrieve a task by id via service', function () {
    $task = Task::factory()->create(['project_id' => $this->project->id]);

    $retrievedTask = $this->taskService->getTaskById($task->id);

    expect($retrievedTask)->toBeInstanceOf(Task::class);
    expect($retrievedTask->id)->toBe($task->id);
});
