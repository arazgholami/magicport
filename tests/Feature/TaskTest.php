<?php

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
    $this->project = Project::factory()->create();
});

it('can add a task to a project', function () {
    $data = [
        'name' => 'New Task',
        'description' => 'New Task Description',
        'status' => 'todo',
    ];

    $response = $this->post(route('tasks.store', $this->project->id), $data);

    $response->assertRedirect();
    $this->assertDatabaseHas('tasks', ['name' => 'New Task', 'project_id' => $this->project->id]);
});

it('validates task creation request', function () {
    $response = $this->post(route('tasks.store', $this->project->id), []);

    $response->assertSessionHasErrors(['name', 'status']);
});

it('can update a task', function () {
    $task = Task::factory()->create(['project_id' => $this->project->id]);

    $data = [
        'name' => 'Updated Task',
        'description' => 'Updated Task Description',
        'status' => 'done',
    ];

    $response = $this->put(route('tasks.update', [$this->project->id, $task->id]), $data);

    $response->assertRedirect();
    $this->assertDatabaseHas('tasks', ['name' => 'Updated Task', 'status' => 'done']);
});

it('can delete a task', function () {
    $task = Task::factory()->create(['project_id' => $this->project->id]);

    $response = $this->delete(route('tasks.destroy', [$this->project->id, $task->id]));

    $response->assertRedirect();
    $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
});
