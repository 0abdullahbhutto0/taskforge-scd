<x-sidebar>
    <div class="w-full bg-gray-50 min-h-screen">
        <div class="p-6">
            <!-- Header -->
            <div class="mb-6">
                <div class="flex justify-between items-center mb-2">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Good morning, {{ $user->name }} 👋</h1>
                        <p class="text-gray-600">Here's what's on your plate for {{ now()->format('l, F jS') }}.</p>
                    </div>
                    <div class="flex items-center gap-4">
                       <form action="/employee/search" method="POST" class="relative">
                                @csrf
                                <input type="text" name="search"
                                    class="pl-3 pr-10 py-2 bg-white border text-black border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500"
                                    placeholder="Search...">
                                <button type="submit" class="absolute right-2 top-2 text-gray-400 hover:text-gray-600">
                                    Search
                                </button>
                            </form>
                        <a href="/tasks" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700">
                            + Create New Task
                        </a>
                    </div>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                @php
                    $tasksDueToday = $user->assignedTasks()->whereDate('due_date', today())->count();
                    $pendingReviews = $user->assignedTasks()->where('status', 'review')->count();
                    $activeProjects = $user->workspaces()->count();
                @endphp
                
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mb-2">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="text-2xl font-bold text-gray-900">{{ $tasksDueToday }}</div>
                    <div class="text-sm text-gray-600">Tasks Due Today</div>
                    <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                        <div class="bg-red-600 h-2 rounded-full" style="width: {{ min(($tasksDueToday / 10) * 100, 100) }}%"></div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center mb-2">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div class="text-2xl font-bold text-gray-900">{{ $pendingReviews }}</div>
                    <div class="text-sm text-gray-600">Pending Reviews</div>
                    <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                        <div class="bg-orange-600 h-2 rounded-full" style="width: {{ min(($pendingReviews / 10) * 100, 100) }}%"></div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mb-2">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div class="text-2xl font-bold text-gray-900">{{ $activeProjects }}</div>
                    <div class="text-sm text-gray-600">Active Projects</div>
                    <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                        <div class="bg-blue-600 h-2 rounded-full" style="width: {{ min(($activeProjects / 5) * 100, 100) }}%"></div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- My Tasks -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex justify-between items-center mb-4">
                        <div>
                            <h2 class="text-xl font-bold text-gray-900">My Tasks</h2>
                            <span class="text-sm text-gray-600">{{ $user->assignedTasks()->where('status', '!=', 'completed')->count() }} Active</span>
                        </div>
                    </div>
                    
                    <div class="space-y-3">
                        @foreach($user->assignedTasks()->where('status', '!=', 'completed')->take(4)->get() as $task)
                        <a href="/tasks/{{ $task->id }}" class="flex items-start gap-3 p-3 hover:bg-gray-50 rounded-lg">
                            <div class="flex-1">
                                <div class="font-medium text-gray-900 hover:text-blue-600">{{ $task->title }}</div>
                                <div class="text-sm text-gray-500">{{ $task->workspace->name ?? 'No workspace' }} • #{{ $task->id }}</div>
                            </div>
                            <div class="flex flex-col items-end gap-1">
                                @if($task->priority === 'high' || $task->priority === 'critical')
                                    <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs font-medium">High Priority</span>
                                @elseif($task->priority === 'medium')
                                    <span class="bg-orange-100 text-orange-700 px-2 py-1 rounded text-xs font-medium">Medium</span>
                                @else
                                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-medium">Low</span>
                                @endif
                                <span class="text-xs text-gray-500">
                                    @if($task->due_date)
                                        @if($task->due_date->isToday())
                                            Today
                                        @elseif($task->due_date->isTomorrow())
                                            Tomorrow
                                        @else
                                            {{ $task->due_date->format('M d') }}
                                        @endif
                                    @else
                                        No due date
                                    @endif
                                </span>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    
                    <div class="mt-4">
                        <a href="/tasks" class="text-blue-600 hover:text-blue-700 text-sm font-medium">View All Tasks</a>
                    </div>
                </div>

                <!-- Active Projects -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-bold text-gray-900">Active Projects</h2>
                        <a href="/workspaces" class="text-blue-600 hover:text-blue-700 text-sm font-medium">View All</a>
                    </div>
                    
                    <div class="space-y-4">
                        @foreach($user->workspaces()->take(2)->get() as $workspace)
                        @php
                            $totalTasks = $workspace->tasks->count();
                            $completedTasks = $workspace->tasks->where('status', 'completed')->count();
                            $progress = $totalTasks > 0 ? ($completedTasks / $totalTasks) * 100 : 0;
                        @endphp
                        <div class="border rounded-lg p-4">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <div class="font-bold text-gray-900">{{ $workspace->name }}</div>
                                    <div class="text-sm text-gray-600 mb-2">{{ $workspace->description ?? 'No description' }}</div>
                                    <div class="text-sm text-gray-600 mb-1">Progress {{ number_format($progress) }}%</div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $progress }}%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Announcements -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Announcements</h2>
                
                <div class="space-y-4">
                    @php
                        $announcements = \App\Models\Announcement::with('creator')->latest()->take(5)->get();
                    @endphp
                    @foreach($announcements as $announcement)
                    <div class="flex gap-3">
                        <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-1">
                                <div class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 text-xs font-medium">
                                    {{ substr($announcement->creator->name, 0, 1) }}
                                </div>
                                <span class="text-sm font-medium text-gray-900">{{ $announcement->creator->name }}</span>
                            </div>
                            <div class="font-medium text-gray-900 mb-1">{{ $announcement->title }}</div>
                            <div class="text-sm text-gray-600">{{ $announcement->content }}</div>
                            <div class="text-xs text-gray-500 mt-1">{{ $announcement->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                    @endforeach
                    
                    @if($announcements->isEmpty())
                        <p class="text-gray-500 text-center py-4">No announcements yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-sidebar>
