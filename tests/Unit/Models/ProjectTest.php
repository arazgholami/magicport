<?php

use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(Tests\TestCase::class, RefreshDatabase::class);

it('can create a project', function () {
    $project = Project::factory()->create([
        'name' => 'Test Project',
        'description' => 'Test Description',
    ]);

    expect($project)->toBeInstanceOf(Project::class);
    expect($project->name)->toBe('Test Project');
    expect($project->description)->toBe('Test Description');
});

it('can update a project', function () {
    $project = Project::factory()->create();

    $project->update([
        'name' => 'Updated Project Name',
        'description' => 'Updated Description',
    ]);

    expect($project->name)->toBe('Updated Project Name');
    expect($project->description)->toBe('Updated Description');
});

it('can delete a project', function () {
    $project = Project::factory()->create();

    $project->delete();

    $this->assertDatabaseMissing('projects', ['id' => $project->id]);
});

it('project has tasks relationship', function () {
    $project = Project::factory()->create();
    $tasks = Task::factory()->count(3)->create(['project_id' => $project->id]);

    expect($project->tasks)->toHaveCount(3);
    expect($project->tasks->first())->toBeInstanceOf(Task::class);
});
