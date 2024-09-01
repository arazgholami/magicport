<?php

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

it('can list projects', function () {
    Project::factory()->count(3)->create();

    $response = $this->get(route('projects.index'));

    $response->assertStatus(200);
    $response->assertViewHas('projects');
    expect($response['projects'])->toHaveCount(3);
});

it('can create a project', function () {
    $data = [
        'name' => 'New Project',
        'description' => 'New Project Description',
    ];

    $response = $this->post(route('projects.store'), $data);

    $response->assertRedirect();
    $this->assertDatabaseHas('projects', ['name' => 'New Project']);
});

it('validates project creation request', function () {
    $response = $this->post(route('projects.store'), []);

    $response->assertSessionHasErrors(['name']);
});

it('can show a project', function () {
    $project = Project::factory()->create();

    $response = $this->get(route('projects.show', $project->id));

    $response->assertStatus(200);
    $response->assertViewHas('project', $project);
});

it('can update a project', function () {
    $project = Project::factory()->create();

    $data = [
        'name' => 'Updated Project',
        'description' => 'Updated Description',
    ];

    $response = $this->put(route('projects.update', $project->id), $data);

    $response->assertRedirect();
    $this->assertDatabaseHas('projects', ['name' => 'Updated Project']);
});

it('can delete a project', function () {
    $project = Project::factory()->create();

    $response = $this->delete(route('projects.destroy', $project->id));

    $response->assertRedirect();
    $this->assertDatabaseMissing('projects', ['id' => $project->id]);
});
