<x-sidebar>
    <div class="w-full bg-gray-50 min-h-screen">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Announcements</h1>
                    <p class="text-gray-600">Manage announcements for your team</p>
                </div>
                <a href="/announcements/create" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700">
                    + Create Announcement
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(auth()->user()->hasRole() === 'Admin')
                <div class="mb-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Public Announcements</h2>
                    <div class="space-y-4">
                        @foreach($publicAnnouncements as $announcement)
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2">
                                        <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center">
                                            <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-gray-900">{{ $announcement->title }}</h3>
                                            <p class="text-sm text-gray-500">By {{ $announcement->creator->name }} • {{ $announcement->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    <p class="text-gray-700">{{ $announcement->content }}</p>
                                </div>
                                <form action="/announcements/{{ $announcement->id }}" method="POST" class="ml-4">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">Delete</button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @if($publicAnnouncements->isEmpty())
                        <div class="bg-white rounded-lg shadow-sm p-8 text-center mt-4">
                            <p class="text-gray-600">No public announcements yet.</p>
                        </div>
                    @endif
                    <div class="mt-4">
                        {{ $publicAnnouncements->appends(['team_page' => request('team_page')])->links() }}
                    </div>
                </div>

                <div>
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Team Announcements</h2>
                    <div class="space-y-4">
                        @foreach($teamAnnouncements as $announcement)
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2">
                                        <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center">
                                            <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-gray-900">{{ $announcement->title }}</h3>
                                            <p class="text-sm text-gray-500">By {{ $announcement->creator->name }} • {{ $announcement->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    <p class="text-gray-700">{{ $announcement->content }}</p>
                                </div>
                                <form action="/announcements/{{ $announcement->id }}" method="POST" class="ml-4">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">Delete</button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @if($teamAnnouncements->isEmpty())
                        <div class="bg-white rounded-lg shadow-sm p-8 text-center mt-4">
                            <p class="text-gray-600">No team announcements yet.</p>
                        </div>
                    @endif
                    <div class="mt-4">
                        {{ $teamAnnouncements->appends(['public_page' => request('public_page')])->links() }}
                    </div>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($announcements as $announcement)
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-gray-900">{{ $announcement->title }}</h3>
                                        <p class="text-sm text-gray-500">By {{ $announcement->creator->name }} • {{ $announcement->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <p class="text-gray-700">{{ $announcement->content }}</p>
                            </div>
                            @if(auth()->user()->hasRole() === 'Manager' && $announcement->created_by === auth()->id())
                            <form action="/announcements/{{ $announcement->id }}" method="POST" class="ml-4">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">Delete</button>
                            </form>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="mt-4">
                    {{ $announcements->links() }}
                </div>

                @if($announcements->isEmpty())
                    <div class="bg-white rounded-lg shadow-sm p-12 text-center mt-4">
                        <p class="text-gray-600">No announcements yet. Create one to get started!</p>
                    </div>
                @endif
            @endif
        </div>
    </div>
</x-sidebar>
