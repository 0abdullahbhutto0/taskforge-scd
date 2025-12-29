<x-sidebar>
    <div class="w-full bg-gray-50 min-h-screen">
        <div class="p-6">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900">User Management</h1>
                <p class="text-gray-600">Manage users and their roles</p>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b">
                                <th class="text-left py-3 px-4 text-sm font-medium text-gray-700">USER</th>
                                <th class="text-left py-3 px-4 text-sm font-medium text-gray-700">ROLE</th>
                                <th class="text-left py-3 px-4 text-sm font-medium text-gray-700">STATUS</th>
                                <th class="text-left py-3 px-4 text-sm font-medium text-gray-700">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3 px-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-medium text-sm">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-900">{{ $user->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 px-4">
                                    <span class="text-sm text-gray-700">{{ $user->roles->first()->name ?? 'Unassigned' }}</span>
                                </td>
                                <td class="py-3 px-4">
                                    @if($user->status === 'approved')
                                        <span class="inline-flex items-center gap-1">
                                            <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                            <span class="text-sm text-gray-700">Approved</span>
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1">
                                            <span class="w-2 h-2 bg-orange-500 rounded-full"></span>
                                            <span class="text-sm text-gray-700">Pending</span>
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3 px-4">
                                    @if($user->status === 'pending')
                                        <div class="flex gap-2">
                                            <form action="/admin/users/{{ $user->id }}/approve" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">Approve</button>
                                            </form>
                                            <form action="/admin/users/{{ $user->id }}/assign-role" method="POST" class="inline">
                                                @csrf
                                                <select name="role" onchange="this.form.submit()" class="border rounded px-2 py-1 text-sm text-black">
                                                    <option value="" class="text-black">Assign Role</option>
                                                    <option value="Admin">Admin</option>
                                                    <option value="Manager">Manager</option>
                                                    <option value="Employee">Employee</option>
                                                </select>
                                            </form>
                                            <form action="/admin/users/{{ $user->id }}/reject" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded text-sm hover:bg-red-700">Reject</button>
                                            </form>
                                        </div>
                                    @else
                                        <form action="/admin/users/{{ $user->id }}/assign-role" method="POST" class="inline">
                                            @csrf
                                            <select name="role" onchange="this.form.submit()" class="border rounded px-2 py-1 text-sm text-black">
                                                <option value="{{ $user->roles->first()->name ?? '' }}">{{ $user->roles->first()->name ?? 'Unassigned' }}</option>
                                                <option value="Admin">Admin</option>
                                                <option value="Manager">Manager</option>
                                                <option value="Employee">Employee</option>
                                            </select>
                                        </form>
                                    @endif
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
