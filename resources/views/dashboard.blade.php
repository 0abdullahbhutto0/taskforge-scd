<x-sidebar>
    <div class="w-full">
        @if ($user->status === 'pending' || $user->hasRole() === 'Unassigned')
            <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                <div class="max-w-md mx-auto">
                    <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold text-gray-900 mb-2">Account Pending Approval</h1>
                    <p class="text-gray-600 mb-4">Sit tight, we're reviewing your request. An administrator will approve your account soon.</p>
                    <p class="text-sm text-gray-500">Your current status: <span class="font-medium">{{ ucfirst($user->status) }}</span></p>
                    <p class="text-sm text-gray-500 mt-2">Your current role: <span class="font-medium">{{ $user->hasRole() }}</span></p>
                </div>
            </div>
        @else
            <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                <div class="max-w-md mx-auto">
                    <h1 class="text-2xl font-bold text-gray-900 mb-2">Redirecting...</h1>
                    <p class="text-gray-600">Please wait while we redirect you to your dashboard.</p>
                    <script>
                        setTimeout(function() {
                            window.location.href = '/dashboard';
                        }, 1000);
                    </script>
                </div>
            </div>
        @endif
    </div>
</x-sidebar>
