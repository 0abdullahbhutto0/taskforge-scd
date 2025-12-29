<x-sidebar>
    <div class="w-full bg-gray-50 min-h-screen">
        <div class="p-6">
            <!-- Header -->
            <div class="mb-6">
                <div class="flex justify-between items-center mb-2">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Admin Dashboard</h1>
                        <p class="text-gray-600">Dashboard Overview</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <form action="/admin/search" method="POST" class="relative">
                                @csrf
                                <input type="text" name="search"
                                    class="pl-3 pr-10 py-2 bg-white border text-black border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500"
                                    placeholder="Search...">
                                <button type="submit" class="absolute right-2 top-2 text-gray-400 hover:text-gray-600">
                                    Search
                                </button>
                            </form>
                        <a href="/admin/users" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700">
                            + Invite User
                        </a>
                    </div>
                </div>
            </div>

            <!-- System Overview -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">System Overview</h2>
                        <p class="text-gray-600 text-sm">Real-time insights into your organization's performance.</p>
                    </div>
                    <div class="text-sm text-gray-500">Last updated: Just now</div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-300 shadow-xl hover:shadow-none transition-shadow duration-200">
                        <div class="flex items-center justify-between mb-2">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            
                        </div>
                        <div class="text-2xl font-bold text-gray-900">{{ $totalUsers }}</div>
                        <div class="text-sm text-gray-600">Total Users</div>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-300 shadow-xl hover:shadow-none transition-shadow duration-200">
                        <div class="flex items-center justify-between mb-2">
                            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>
                            <span class="text-green-600 text-sm font-medium flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                                +5%
                            </span>
                        </div>
                        <div class="text-2xl font-bold text-gray-900">{{ $activeWorkspaces }}</div>
                        <div class="text-sm text-gray-600">Active Workspaces</div>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-300 shadow-xl hover:shadow-none transition-shadow duration-200">
                        <div class="flex items-center justify-between mb-2">
                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                        </div>
                        <div class="text-2xl font-bold text-gray-900">99.9%</div>
                        <div class="text-sm text-gray-600">System Health</div>
                        <div class="text-xs text-green-600 mt-1">Stable</div>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-300 shadow-xl hover:shadow-none transition-shadow duration-200">
                        <div class="flex items-center justify-between mb-2">
                            <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <span class="bg-orange-100 text-orange-600 text-xs font-medium px-2 py-1 rounded-full">{{ $pendingUsers }} New</span>
                        </div>
                        <div class="text-2xl font-bold text-gray-900">{{ $pendingUsers }}</div>
                        <div class="text-sm text-gray-600">Pending Invites</div>
                    </div>
                </div>
            </div>

            <!-- Recent Users -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold text-gray-900">Recent Users</h2>
                    <div class="flex gap-2">
                        <a href="/admin/users" class="text-blue-600 hover:text-blue-700 text-sm font-medium">View All</a>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b">
                                <th class="text-left py-3 px-4 text-sm font-medium text-gray-700">USER</th>
                                <th class="text-left py-3 px-4 text-sm font-medium text-gray-700">ROLE</th>
                                <th class="text-left py-3 px-4 text-sm font-medium text-gray-700">STATUS</th>
                                <th class="text-left py-3 px-4 text-sm font-medium text-gray-700">LAST ACTIVE</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentUsers as $recentUser)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3 px-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-medium text-sm">
                                            {{ substr($recentUser->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-900">{{ $recentUser->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $recentUser->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 px-4">
                                    <span class="text-sm text-gray-700">{{ $recentUser->roles->first()->name ?? 'Unassigned' }}</span>
                                </td>
                                <td class="py-3 px-4">
                                    @if($recentUser->status === 'approved')
                                        <span class="inline-flex items-center gap-1">
                                            <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                            <span class="text-sm text-gray-700">Active</span>
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1">
                                            <span class="w-2 h-2 bg-orange-500 rounded-full"></span>
                                            <span class="text-sm text-gray-700">Pending</span>
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-sm text-gray-600">
                                    {{ $recentUser->created_at->diffForHumans() }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-sidebar>
