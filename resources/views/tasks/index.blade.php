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

            <div class="bg-white p-4 rounded-lg shadow-sm mb-6 flex gap-4">
                <form action="/tasks" method="GET" class="w-full flex flex-col sm:flex-row gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" class="bg-white text-black border-gray-300 rounded-md shadow-sm text-sm border p-2">
                            <option value="">All Statuses</option>
                            <option value="todo" {{ request('status') === 'todo' ? 'selected' : '' }}>To Do</option>
                            <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="review" {{ request('status') === 'review' ? 'selected' : '' }}>Review</option>
                            <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="blocked" {{ request('status') === 'blocked' ? 'selected' : '' }}>Blocked</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Priority</label>
                        <select name="priority" class="bg-white text-black border-gray-300 rounded-md shadow-sm text-sm border p-2">
                            <option value="">All Priorities</option>
                            <option value="low" {{ request('priority') === 'low' ? 'selected' : '' }}>Low</option>
                            <option value="medium" {{ request('priority') === 'medium' ? 'selected' : '' }}>Medium</option>
                            <option value="high" {{ request('priority') === 'high' ? 'selected' : '' }}>High</option>
                            <option value="critical" {{ request('priority') === 'critical' ? 'selected' : '' }}>Critical</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Sort By</label>
                        <select name="sort" class="bg-white text-black border-gray-300 rounded-md shadow-sm text-sm border p-2">
                            <option value="latest" {{ request('sort') !== 'due_date' ? 'selected' : '' }}>Latest Created</option>
                            <option value="due_date" {{ request('sort') === 'due_date' ? 'selected' : '' }}>Due Date</option>
                        </select>
                    </div>
                    <div class="flex items-end gap-2">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded shadow text-sm font-medium hover:bg-blue-700">Apply Filters</button>
                        <a href="/tasks" class="bg-gray-100 text-gray-700 border px-4 py-2 rounded shadow-sm text-sm font-medium hover:bg-gray-200">Clear</a>
                    </div>
                </form>
            </div>

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
                                <th class="text-left py-3 px-4 text-sm font-medium text-gray-700">Actions</th>
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
                                        <select name="status" onchange="this.form.submit()" class="text-xs border rounded bg-white text-black px-2 py-1">
                                            <option value="todo" {{ $task->status->value === 'todo' ? 'selected' : '' }}>To Do</option>
                                            <option value="in_progress" {{ $task->status->value === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                            <option value="review" {{ $task->status->value === 'review' ? 'selected' : '' }}>Review</option>
                                            <option value="completed" {{ $task->status->value === 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="blocked" {{ $task->status->value === 'blocked' ? 'selected' : '' }}>Blocked</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="py-3 px-4">
                                    @if ($task->priority->value === 'critical' || $task->priority->value === 'high')
                                        <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs font-medium">{{ $task->priority->label() }}</span>
                                    @elseif($task->priority->value === 'medium')
                                        <span class="bg-orange-100 text-orange-700 px-2 py-1 rounded text-xs font-medium">{{ $task->priority->label() }}</span>
                                    @else
                                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-medium">{{ $task->priority->label() }}</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-sm text-gray-600">
                                    {{ $task->due_date ? $task->due_date->format('M d, Y') : 'No due date' }}
                                </td>
                                <td class="py-3 px-4">
                                    @if(auth()->user()->hasRole() === 'Admin' || (auth()->user()->hasRole() === 'Manager' && $task->created_by === auth()->id()))
                                    <form action="/tasks/{{ $task->id }}" method="POST" class="inline" onsubmit="return confirm('Delete this task?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">Delete</button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $tasks->links() }} <!-- Pagination task -->
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
