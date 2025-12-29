<x-sidebar>
    <div class="min-h-screen bg-gray-50 p-8">
    <div class="max-w-6xl mx-auto">
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Search Results</h1>
            <p class="text-gray-500">Showing results for "{{ $query }}"</p>
            
            <form action="/admin/search" method="POST" class="mt-4 relative max-w-xl">
                @csrf
                <input type="text" name="search" value="{{ $query }}" 
                    class="w-full pl-4 pr-12 py-3 text-black bg-white border-none rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500"
                    placeholder="Search tasks, projects, or people...">
                <button type="submit" class="absolute right-3 top-2.5 text-gray-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </button>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <section class="md:col-span-2">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Workspaces & Projects</h2>
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 border-b border-gray-100">
                            <tr>
                                <th class="px-6 py-4 text-xs font-semibold text-gray-400 uppercase">Project Name</th>
                                <th class="px-6 py-4 text-xs font-semibold text-gray-400 uppercase text-center">Lead</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($workspaces as $workspace)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-800">{{ $workspace->name }}</div>
                                    <div class="text-xs text-gray-400">{{ $workspace->description }}</div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 text-blue-600 text-xs font-bold">
                                        {{ substr($workspace->creator->name, 0, 1) }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>

            <section>
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Team Members</h2>
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 space-y-4">
                    @foreach($employees as $employee)
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-500 flex items-center justify-center font-bold">
                            {{ substr($employee->name, 0, 1) }}
                        </div>
                        <div>
                            <div class="text-sm font-semibold text-gray-800">{{ $employee->name }}</div>
                            <div class="text-xs text-gray-400">{{ $employee->email }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
</div>
</x-sidebar>