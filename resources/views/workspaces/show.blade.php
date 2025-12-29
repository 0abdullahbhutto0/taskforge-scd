<x-sidebar>
    <div class="w-full bg-gray-50 min-h-screen">
        <div class="p-6">
            <div class="mb-6">
                <div class="flex items-center gap-4 mb-2">
                    <a href="/workspaces" class="text-blue-600 hover:text-blue-700 text-sm">← Back to Workspaces</a>
                </div>
                <h1 class="text-2xl font-bold text-gray-900">{{ $workspace->name }}</h1>
                <p class="text-gray-600">{{ $workspace->description ?? 'No description' }}</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Tasks</h2>
                        
                        <div class="space-y-3">
                            @foreach($workspace->tasks as $task)
                            <a href="/tasks/{{ $task->id }}" class="block border rounded-lg p-4 hover:bg-gray-50">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <div class="font-medium text-gray-900 mb-1">{{ $task->title }}</div>
                                        <div class="text-sm text-gray-600 mb-2">{{ $task->description ?? 'No description' }}</div>
                                        <div class="flex items-center gap-4 text-xs text-gray-500">
                                            <span>Assigned to: {{ $task->assignedTo->name ?? 'Unassigned' }}</span>
                                            @if($task->due_date)
                                                <span>Due: {{ $task->due_date->format('M d, Y') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-end gap-2">
                                        @if($task->priority === 'critical' || $task->priority === 'high')
                                            <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs font-medium">{{ ucfirst($task->priority) }}</span>
                                        @elseif($task->priority === 'medium')
                                            <span class="bg-orange-100 text-orange-700 px-2 py-1 rounded text-xs font-medium">{{ ucfirst($task->priority) }}</span>
                                        @else
                                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-medium">{{ ucfirst($task->priority) }}</span>
                                        @endif
                                        <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs font-medium">{{ ucfirst(str_replace('_', ' ', $task->status)) }}</span>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>

                        @if($workspace->tasks->isEmpty())
                            <p class="text-gray-600 text-center py-8">No tasks in this workspace yet.</p>
                        @endif
                    </div>
                </div>

                <div>
                    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                        <h3 class="font-bold text-gray-900 mb-4">Team Members</h3>
                        <div class="space-y-3">
                            @foreach($workspace->users as $member)
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-medium text-sm">
                                    {{ substr($member->name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="font-medium text-gray-900 text-sm">{{ $member->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $member->email }}</div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h3 class="font-bold text-gray-900 mb-4">Workspace Info</h3>
                        <div class="space-y-2 text-sm">
                            <div>
                                <span class="text-gray-600">Created by:</span>
                                <span class="text-gray-900 font-medium ml-2">{{ $workspace->creator->name ?? 'Unknown' }}</span>
                            </div>
                            <div>
                                <span class="text-gray-600">Created:</span>
                                <span class="text-gray-900 font-medium ml-2">{{ $workspace->created_at->format('M d, Y') }}</span>
                            </div>
                            <div>
                                <span class="text-gray-600">Total Tasks:</span>
                                <span class="text-gray-900 font-medium ml-2">{{ $workspace->tasks->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-sidebar>
