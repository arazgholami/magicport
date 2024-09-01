<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="flex justify-between items-center mb-6">
                        @can('manage-projects')
                            <a href="{{ route('projects.edit', $project) }}" class="bg-blue hover:bg-blue-light text-white font-bold py-2 px-4 rounded">
                                Edit Project
                            </a>
                        @endcan
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2">Description:</h3>
                        <p class="text-gray-600">{{ $project->description }}</p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2">Tasks:</h3>
                        @forelse ($project->tasks as $task)
                            <div class="bg-gray-100 p-4 rounded-lg mb-4">
                                <div class="flex justify-between items-center">
                                    <h4 class="text-md font-semibold">{{ $task->name }}</h4>
                                    <div>
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full
                                            {{ $task->status == 'todo' ? 'bg-red-200 text-red-800' : '' }}
                                            {{ $task->status == 'in-progress' ? 'bg-yellow-200 text-yellow-800' : '' }}
                                            {{ $task->status == 'done' ? 'bg-green-200 text-green-800' : '' }}
                                        ">
                                            {{ ucfirst($task->status) }}
                                        </span>
                                        @can('manage-tasks', $project)
                                            <button x-data x-on:click="$dispatch('open-task-modal', { taskId: {{ $task->id }} })" class="ml-2 text-blue-600 hover:text-blue-800">
                                                Edit
                                            </button>
                                            <form action="{{ route('tasks.destroy', ['project' => $project->id, 'task' => $task->id]) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="ml-2 text-red-600 hover:text-red-800" onclick="return confirm('Are you sure you want to delete this task?')">
                                                    Delete
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </div>
                                <p class="text-gray-600 mt-2">{{ $task->description }}</p>
                            </div>
                            <x-task-edit-modal :task="$task" />
                        @empty
                            <p class="text-gray-500">No tasks yet.</p>
                        @endforelse
                    </div>

                    @can('manage-tasks', $project)
                        <div class="mt-6">
                            <h3 class="text-lg font-semibold mb-2">Add New Task:</h3>
                            <form action="{{ route('tasks.store', $project->id) }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Task Name:</label>
                                    <input type="text" name="name" id="name" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                                </div>
                                <div class="mb-4">
                                    <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
                                    <textarea name="description" id="description" rows="3" class="form-textarea rounded-md shadow-sm mt-1 block w-full"></textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status:</label>
                                    <select name="status" id="status" class="form-select rounded-md shadow-sm mt-1 block w-full">
                                        <option value="todo">Todo</option>
                                        <option value="in-progress">In Progress</option>
                                        <option value="done">Done</option>
                                    </select>
                                </div>
                                <div class="flex items-center justify-end mt-4">
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Add Task
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
