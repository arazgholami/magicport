<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Create Project Manager
        $pmUser = User::factory()->create([
            'name' => 'Project Manager',
            'email' => 'pm@magicport.com',
            'password' => bcrypt('12345678'),
        ]);

        //Create Task Manager
        $tmUser = User::factory()->create([
            'name' => 'Task Manager',
            'email' => 'tm@magicport.com',
            'password' => bcrypt('12345678'),
        ]);

        //Create Roles and Permissions + Assign Roles
        $pmRole = Role::create(['name' => 'project-manager']);
        $permission = Permission::create(['name' => 'manage-projects']);
        $pmRole->givePermissionTo($permission);
        $pmUser->assignRole('project-manager');

        $tmRole = Role::create(['name' => 'task-manager']);
        $permission = Permission::create(['name' => 'manage-tasks']);
        $tmRole->givePermissionTo($permission);
        $pmUser->assignRole('task-manager');
        $tmUser->assignRole('task-manager');
    }
}
