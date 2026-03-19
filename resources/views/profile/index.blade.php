<x-sidebar>
    <div class="w-full bg-gray-50 min-h-screen">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Your Profile</h1>
                    <p class="text-gray-600">Manage your account settings and preferences</p>
                </div>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Profile Settings Form -->
                <div class="md:col-span-2">
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Personal Information</h2>
                        
                        <form action="/profile" method="POST" enctype="multipart/form-data" class="space-y-6">
                            @csrf
                            
                            <!-- Avatar Upload -->
                            <div>
                                <label class="block text-sm font-medium text-gray-900 mb-2">Profile Photo</label>
                                <div class="flex items-center gap-6">
                                    <div class="w-20 h-20 rounded-full border-2 border-gray-100 overflow-hidden bg-gray-50 flex items-center justify-center shrink-0">
                                        @if($user->avatar)
                                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="w-full h-full object-cover">
                                        @else
                                            <span class="text-2xl font-bold text-gray-400">{{ substr($user->name, 0, 1) }}</span>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <input type="file" name="avatar" accept="image/*" class="block w-full text-sm text-gray-500
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded-md file:border-0
                                            file:text-sm file:font-semibold
                                            file:bg-blue-50 file:text-blue-700
                                            hover:file:bg-blue-100
                                        "/>
                                        <p class="mt-1 text-xs text-gray-500">PNG, JPG, GIF up to 5MB</p>
                                    </div>
                                </div>
                                @error('avatar')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>

                            <!-- Name Input -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-900 mb-2">Full Name</label>
                                <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" required
                                    class="block w-full rounded-md bg-white px-3 py-2 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-blue-600 sm:text-sm/6" />
                                @error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>

                            <!-- Email (Read-Only) -->
                            <div>
                                <label class="block text-sm font-medium text-gray-900 mb-2">Email Address</label>
                                <input type="email" value="{{ $user->email }}" disabled
                                    class="block w-full rounded-md bg-gray-50 px-3 py-2 text-base text-gray-500 border border-gray-200 cursor-not-allowed sm:text-sm/6" />
                                <p class="mt-1 text-xs text-gray-500">Email cannot be changed natively. Contact support if you need to transfer accounts.</p>
                            </div>

                            <div class="pt-4 border-t">
                                <button type="submit"
                                    class="bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Contextual Sidebar Stats -->
                <div class="md:col-span-1 space-y-6">
                    <div class="bg-white rounded-lg shadow-sm p-6 border-t-4 border-blue-500">
                        <h2 class="text-lg font-bold text-gray-900 mb-4">Account Overview</h2>
                        
                        <div class="space-y-4">
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">System Role</p>
                                <p class="text-sm font-medium text-gray-900">{{ $role }}</p>
                            </div>

                            @if($role === 'Manager')
                                <div class="pt-3 border-t">
                                    <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold mb-1">Active Subscription</p>
                                    <p class="text-sm font-medium text-blue-700 bg-blue-50 py-1 px-2 mb-3 rounded border border-blue-100 inline-block">{{ $planDetails }}</p>
                                    <a href="/billing" class="block w-full text-center bg-gray-50 border py-2 text-sm text-gray-700 font-medium rounded-lg hover:bg-gray-100">
                                        Manage Billing
                                    </a>
                                </div>
                            @elseif($role === 'Employee')
                                <div class="pt-3 border-t">
                                    <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold mb-1">Assigned Manager</p>
                                    @if($managerDetails)
                                        <div class="flex items-center gap-3 mt-2">
                                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-bold text-xs shrink-0 overflow-hidden">
                                                @if($managerDetails->avatar)
                                                    <img src="{{ asset('storage/' . $managerDetails->avatar) }}" alt="Avatar" class="w-full h-full object-cover">
                                                @else
                                                    {{ substr($managerDetails->name, 0, 1) }}
                                                @endif
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">{{ $managerDetails->name }}</p>
                                                <p class="text-xs text-gray-500">{{ $managerDetails->email }}</p>
                                            </div>
                                        </div>
                                    @else
                                        <p class="text-sm font-medium text-red-600">Orphaned Account</p>
                                    @endif
                                </div>
                            @elseif($role === 'Admin')
                                <div class="pt-3 border-t">
                                    <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold mb-1">System Privilege</p>
                                    <p class="text-sm font-medium text-gray-900">Total System Control</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-sidebar>
