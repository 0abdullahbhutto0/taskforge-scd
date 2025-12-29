<x-sidebar>
    <div class="w-full bg-gray-50 min-h-screen">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Tasks</h1>
                    <p class="text-gray-600">View and manage your tasks</p>
                </div>
                @if(auth()->user()->hasRole() === 'Manager' || auth()->user()->hasRole() === 'Admin')
                    <a href="/tasks/create" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700">
                        + Create Task
                    </a>
                @endif
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="text-left py-3 px-4 text-sm font-medium text-gray-700">Task</th>
                                <th class="text-left py-3 px-4 text-sm font-medium text-gray-700">Workspace</th>
                                <th class="text-left py-3 px-4 text-sm font-medium text-gray-700">Assigned To</th>
                                <th class="text-left py-3 px-4 text-sm font-medium text-gray-700">Status</th>
                                <th class="text-left py-3 px-4 text-sm font-medium text-gray-700">Priority</th>
                                <th class="text-left py-3 px-4 text-sm font-medium text-gray-700">Due Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tasks as $task)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3 px-4">
                                    <a href="/tasks/{{ $task->id }}" class="font-medium text-gray-900 hover:text-blue-600">{{ $task->title }}</a>
                                    <div class="text-sm text-gray-500">{{ Str::limit($task->description ?? 'No description', 50) }}</div>
                                </td>
                                <td class="py-3 px-4 text-sm text-gray-600">
                                    <a href="/workspaces/{{ $task->workspace_id ?? '#' }}" class="hover:text-blue-600">{{ $task->workspace->name ?? 'N/A' }}</a>
                                </td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 text-xs">
                                            {{ substr($task->assignedTo->name ?? 'N', 0, 1) }}
                                        </div>
                                        <span class="text-sm text-gray-700">{{ $task->assignedTo->name ?? 'Unassigned' }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-4">
                                    <form action="/tasks/{{ $task->id }}/status" method="POST" class="inline">
                                        @csrf
                                        <select name="status" onchange="this.form.submit()" class="text-xs border rounded px-2 py-1 text-black">
                                            <option value="todo" {{ $task->status === 'todo' ? 'selected' : '' }}>To Do</option>
                                            <option value="in_progress" {{ $task->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                            <option value="review" {{ $task->status === 'review' ? 'selected' : '' }}>Review</option>
                                            <option value="completed" {{ $task->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="blocked" {{ $task->status === 'blocked' ? 'selected' : '' }}>Blocked</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="py-3 px-4">
                                    @if($task->priority === 'critical' || $task->priority === 'high')
                                        <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs font-medium">{{ ucfirst($task->priority) }}</span>
                                    @elseif($task->priority === 'medium')
                                        <span class="bg-orange-100 text-orange-700 px-2 py-1 rounded text-xs font-medium">{{ ucfirst($task->priority) }}</span>
                                    @else
                                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-medium">{{ ucfirst($task->priority) }}</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-sm text-gray-600">
                                    {{ $task->due_date ? $task->due_date->format('M d, Y') : 'No due date' }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @if($tasks->isEmpty())
                <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                    <p class="text-gray-600">No tasks found.</p>
                </div>
            @endif
        </div>
    </div>
</x-sidebar>
