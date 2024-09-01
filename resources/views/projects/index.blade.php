<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Projects') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold">All Projects</h3>
                        @can('manage-projects')
                            <a href="{{ route('projects.create') }}" class="bg-blue hover:bg-blue-light text-white font-bold py-2 px-4 rounded">
                                Create New Project
                            </a>
                        @endcan
                    </div>

                    <form action="{{ route('projects.index') }}" method="GET" class="mb-6">
                        <div class="flex items-center">
                            <input type="text" name="search" placeholder="Search projects..." value="{{ request('search') }}" class="form-input rounded-md shadow-sm mt-1 block w-full" />
                            <select name="status" class="form-select rounded-md shadow-sm mt-1 block ml-3">
                                <option value="">All Statuses</option>
                                <option value="todo" {{ request('status') == 'todo' ? 'selected' : '' }}>Todo</option>
                                <option value="in-progress" {{ request('status') == 'in-progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="done" {{ request('status') == 'done' ? 'selected' : '' }}>Done</option>
                            </select>
                            <button type="submit" class="ml-3 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                                Search
                            </button>
                        </div>
                    </form>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($projects as $project)
                            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                                <div class="p-4">
                                    <h4 class="text-xl font-bold mb-2">
                                        <a href="{{ route('projects.show', $project->id) }}" class="text-blue-500 hover:text-blue-700">
                                            {{ $project->name }}
                                        </a>
                                    </h4>
                                    <p class="text-gray-600 mb-4">{{ Str::limit($project->description, 100) }}</p>
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-500">Tasks: {{ $project->tasks_count }}</span>
                                        <span class="text-sm text-gray-500">Created: {{ $project->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6">
                        {{ $projects->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
