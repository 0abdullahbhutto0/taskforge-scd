<x-sidebar>
    <div class="w-full bg-gray-50 min-h-screen">
        <div class="p-6">
            <!-- Header -->
            <div class="mb-6">
                <div class="flex justify-between items-center mb-2">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Manager Dashboard</h1>
                    </div>
                    <div class="flex items-center gap-4">
                        <div>
                            <form action="/manager/search" method="POST" class="relative">
                                @csrf
                                <input type="text" name="search"
                                    class="pl-3 pr-10 py-2 bg-white border text-black border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500"
                                    placeholder="Search...">
                                <button type="submit" class="absolute right-2 top-2 text-gray-400 hover:text-gray-600">
                                    Search
                                </button>
                            </form>
                        </div>
                        <a href="/manager/employees/create"
                            class="bg-gray-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-gray-700">
                            + Add Employee
                        </a>
                        <a href="/tasks/create"
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700">
                            Create Task
                        </a>
                    </div>
                </div>
                <div class="text-sm text-gray-600">Let's get some work done!</div>
            </div>

            <!-- Overview Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex items-center justify-between mb-2">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <span class="text-green-600 text-sm">+2 from yesterday</span>
                    </div>
                    <div class="text-2xl font-bold text-gray-900">{{ $tasksDueToday }}</div>
                    <div class="text-sm text-gray-600">Tasks Due Today</div>
                </div>

                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mb-2">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </div>
                    <div>

                        {{ $progress = $totalTasks > 0 ? ($tasksCompleted / $totalTasks) * 100 : 0 }}

                    </div>
                    <div class="text-2xl font-bold text-gray-900">{{ $progress }}%</div>
                    <div class="text-sm text-gray-600 mb-2">Project Completion</div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-purple-600 h-2 rounded-full" style="width: {{ $progress }}%"></div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center mb-2">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="text-2xl font-bold text-gray-900">{{ $bottlenecks }}</div>
                    <div class="text-sm text-orange-600">Requires attention</div>
                    <div class="text-sm text-gray-600">Bottlenecks</div>
                </div>

                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mb-2">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div class="text-2xl font-bold text-gray-900">24 pts</div>
                    <div class="text-sm text-green-600">Consistent</div>
                    <div class="text-sm text-gray-600">Team Velocity</div>
                </div>
            </div>

            <!-- Active Projects -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold text-gray-900">Active Projects</h2>
                    <div class="flex gap-2">
                        <a href="/workspaces/create" class="text-blue-600 hover:text-blue-700 text-sm font-medium">+ New
                            Workspace</a>
                        <a href="/workspaces" class="text-blue-600 hover:text-blue-700 text-sm font-medium">View All</a>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b">
                                <th class="text-left py-3 px-4 text-sm font-medium text-gray-700">PROJECT NAME</th>
                                <th class="text-left py-3 px-4 text-sm font-medium text-gray-700">LEAD</th>
                                <th class="text-left py-3 px-4 text-sm font-medium text-gray-700">STATUS</th>
                                <th class="text-left py-3 px-4 text-sm font-medium text-gray-700">PROGRESS</th>
                                <th class="text-left py-3 px-4 text-sm font-medium text-gray-700">CREATED AT</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $project)
                                @php
                                    $totalTasksP = $project->tasks->count();
                                    $completedTasksP = $project->tasks->where('status', 'completed')->count();
                                    $progress = $totalTasksP > 0 ? ($completedTasksP / $totalTasksP) * 100 : 0;
                                @endphp
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-3 px-4">
                                        <a href="/workspaces/{{ $project->id }}"
                                            class="font-medium text-gray-900 hover:text-blue-600">{{ $project->name }}</a>
                                        <div class="text-sm text-gray-500">
                                            {{ $project->description ?? 'No description' }}</div>
                                    </td>
                                    <td class="py-3 px-4">
                                        <div
                                            class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-medium text-sm">
                                            {{ substr($project->creator->name, 0, 1) }}
                                        </div>
                                    </td>
                                    <td class="py-3 px-4">
                                        @if ($progress >= 75)
                                            <span
                                                class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs font-medium">On
                                                Track</span>
                                        @elseif($progress < 50)
                                            <span
                                                class="bg-red-100 text-red-700 px-2 py-1 rounded-full text-xs font-medium">Blocked</span>
                                        @else
                                            <span
                                                class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs font-medium">Review</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4">
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-blue-600 h-2 rounded-full"
                                                style="width: {{ $progress }}%"></div>
                                        </div>
                                        <div class="text-xs text-gray-600 mt-1">{{ number_format($progress) }}%</div>
                                    </td>
                                    <td class="py-3 px-4 text-sm text-gray-600">
                                        {{ $project->created_at->format('M d') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Team Pulse -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold text-gray-900">Team Pulse</h2>
                </div>

                <div class="space-y-4">
                    @foreach ($teamMembers->take(4) as $member)
                        <div class="flex items-center gap-4">
                            <div
                                class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-medium">
                                {{ substr($member->name, 0, 1) }}
                            </div>
                            <div class="flex-1">
                                <div class="font-medium text-gray-900">{{ $member->name }}</div>
                                <div class="text-sm text-gray-500">{{ $member->email }}</div>
                            </div>
                            <div class="flex-1">
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    @php
                                        $taskCount = $member->assignedTasks()->count();
                                        $tasksComplete = $member
                                            ->assignedTasks()
                                            ->where('status', 'completed')
                                            ->count();
                                        $progress = $taskCount > 0 ? ($tasksComplete / $taskCount) * 100 : 0;
                                    @endphp
                                    <div class="bg-green-600 h-2 rounded-full" style="width: {{ $progress }}%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-sidebar>
