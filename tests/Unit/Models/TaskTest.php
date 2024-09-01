<?php

use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(Tests\TestCase::class, RefreshDatabase::class);

it('can create a task', function () {
    $project = Project::factory()->create();

    $task = Task::factory()->create([
        'project_id' => $project->id,
        'name' => 'Test Task',
        'description' => 'Test Task Description',
        'status' => 'todo',
    ]);

    expect($task)->toBeInstanceOf(Task::class);
    expect($task->name)->toBe('Test Task');
    expect($task->status)->toBe('todo');
});

it('can update a task', function () {
    $task = Task::factory()->create();

    $task->update([
        'name' => 'Updated Task Name',
        'description' => 'Updated Task Description',
        'status' => 'in-progress',
    ]);

    expect($task->name)->toBe('Updated Task Name');
    expect($task->status)->toBe('in-progress');
});

it('can delete a task', function () {
    $task = Task::factory()->create();

    $task->delete();

    $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
});

it('task belongs to a project', function () {
    $project = Project::factory()->create();
    $task = Task::factory()->create(['project_id' => $project->id]);

    expect($task->project)->toBeInstanceOf(Project::class);
    expect($task->project->id)->toBe($project->id);
});
