<x-sidebar>
    <div class="w-full bg-gray-50 min-h-screen">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Workspaces</h1>
                    <p class="text-gray-600">Manage your workspaces and projects</p>
                </div>
                @if(auth()->user()->hasRole() === 'Manager' || auth()->user()->hasRole() === 'Admin')
                    <a href="/workspaces/create" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700">
                        + Create Workspace
                    </a>
                @endif
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($workspaces as $workspace)
                @php
                    $totalTasks = $workspace->tasks->count();
                    $completedTasks = $workspace->tasks->where('status', 'completed')->count();
                    $progress = $totalTasks > 0 ? ($completedTasks / $totalTasks) * 100 : 0;
                @endphp
                <div class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <a href="/workspaces/{{ $workspace->id }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium">View</a>
                    </div>
                    <a href="/workspaces/{{ $workspace->id }}" class="font-bold text-gray-900 hover:text-blue-600 mb-2 block">{{ $workspace->name }}</a>
                    <p class="text-sm text-gray-600 mb-4">{{ $workspace->description ?? 'No description' }}</p>
                    <div class="mb-2">
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-600">Progress</span>
                            <span class="text-gray-900 font-medium">{{ number_format($progress) }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $progress }}%"></div>
                        </div>
                    </div>
                    <div class="text-xs text-gray-500 mt-2">
                        Created by {{ $workspace->creator->name ?? 'Unknown' }}
                    </div>
                </div>
                @endforeach
            </div>
            {{ $workspaces->links() }} <!-- Pagination task -->

            @if($workspaces->isEmpty())
                <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                    <p class="text-gray-600">No workspaces found.</p>
                </div>
            @endif
        </div>
    </div>
</x-sidebar>
