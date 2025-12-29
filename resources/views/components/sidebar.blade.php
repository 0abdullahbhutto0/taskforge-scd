<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskForge</title>
    @vite(['resources/css/app.css'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="drawer lg:drawer-open">
        <input id="my-drawer-4" type="checkbox" class="drawer-toggle" checked />
        <div class="drawer-content">
            <!-- Navbar -->
            <nav class="navbar w-full bg-white shadow-sm flex justify-between border-b border-gray-200">
                <label for="my-drawer-4" aria-label="open sidebar" class="btn btn-square btn-ghost hover:bg-gray-100">
                    <!-- Sidebar toggle icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-linejoin="round"
                        stroke-linecap="round" stroke-width="2" fill="none" stroke="currentColor"
                        class="my-1.5 inline-block size-4 text-gray-700">
                        <path d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z">
                        </path>
                        <path d="M9 4v16"></path>
                        <path d="M14 10l2 2l-2 2"></path>
                    </svg>
                </label>
                <p class="text-blue-600 font-bold text-lg">TaskForge</p>
                <div class="px-4">
                    @auth
                        <div>
                            <form action="/logout" method="POST">
                                @csrf
                                <button href="/dashboard"
                                    class="bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700 transition">
                                    Logout
                                </button>
                            </form>
                        </div>
                    @endauth
                </div>
            </nav>
            <!-- Page content here -->
            <div>{{ $slot }}</div>
        </div>

        <div class="drawer-side is-drawer-close:overflow-visible">
            <label for="my-drawer-4" aria-label="close sidebar" class="drawer-overlay"></label>
            <div class="flex min-h-full flex-col items-start bg-white border-r border-gray-200 is-drawer-close:w-14 is-drawer-open:w-64">
                <!-- Sidebar content here -->
                <div class="w-full h-16 flex items-center justify-center border-b border-gray-200">
                    <x-logo />
                </div>
                <ul class="menu w-full grow">
                    @auth
                        @php
                            $user = auth()->user();
                            $role = $user->hasRole();
                        @endphp
                        
                        @if($role === 'Admin')
                            <li>
                                <a class="{{ request()->is('admin/dashboard') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }} is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Dashboard" href="/admin/dashboard">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-linejoin="round" stroke-linecap="round" stroke-width="2" fill="none" stroke="currentColor" class="my-1.5 inline-block size-4">
                                        <path d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z"></path>
                                        <path d="M9 4v16"></path>
                                        <path d="M14 10l2 2l-2 2"></path>
                                    </svg>
                                    <span class="is-drawer-close:hidden">Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a class="{{ request()->is('admin/users') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }} is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="User Management" href="/admin/users">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-linejoin="round" stroke-linecap="round" stroke-width="2" fill="none" stroke="currentColor" class="my-1.5 inline-block size-4">
                                        <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                    <span class="is-drawer-close:hidden">User Management</span>
                                </a>
                            </li>
                            <li>
                                <a class="{{ request()->is('announcements*') ? 'bg-blue-600 text-white' : 'text-gray-600 hover:bg-gray-400 hover:text-black' }} is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Announcements" href="/announcements">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-linejoin="round" stroke-linecap="round" stroke-width="2" fill="none" stroke="currentColor" class="my-1.5 inline-block size-4">
                                        <path d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                                    </svg>
                                    <span class="is-drawer-close:hidden">Announcements</span>
                                </a>
                            </li>
                        @elseif($role === 'Manager')
                            <li>
                                <a class="{{ request()->is('manager/dashboard') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }} is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Dashboard" href="/manager/dashboard">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-linejoin="round" stroke-linecap="round" stroke-width="2" fill="none" stroke="currentColor" class="my-1.5 inline-block size-4">
                                        <path d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z"></path>
                                        <path d="M9 4v16"></path>
                                        <path d="M14 10l2 2l-2 2"></path>
                                    </svg>
                                    <span class="is-drawer-close:hidden">Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a class="{{ request()->is('workspaces*') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }} is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Projects" href="/workspaces">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-linejoin="round" stroke-linecap="round" stroke-width="2" fill="none" stroke="currentColor" class="my-1.5 inline-block size-4">
                                        <path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                    <span class="is-drawer-close:hidden">Workspaces</span>
                                </a>
                            </li>
                            <li>
                                <a class="{{ request()->is('tasks*') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }} is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Tasks" href="/tasks">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-linejoin="round" stroke-linecap="round" stroke-width="2" fill="none" stroke="currentColor" class="my-1.5 inline-block size-4">
                                        <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                    <span class="is-drawer-close:hidden">Tasks</span>
                                </a>
                            </li>
                            <li>
                                <a class="{{ request()->is('announcements*') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }} is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Announcements" href="/announcements">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-linejoin="round" stroke-linecap="round" stroke-width="2" fill="none" stroke="currentColor" class="my-1.5 inline-block size-4">
                                        <path d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                                    </svg>
                                    <span class="is-drawer-close:hidden">Announcements</span>
                                </a>
                            </li>
                        @elseif($role === 'Employee')
                            <li>
                                <a class="{{ request()->is('employee/dashboard') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }} is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Dashboard" href="/employee/dashboard">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-linejoin="round" stroke-linecap="round" stroke-width="2" fill="none" stroke="currentColor" class="my-1.5 inline-block size-4">
                                        <path d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z"></path>
                                        <path d="M9 4v16"></path>
                                        <path d="M14 10l2 2l-2 2"></path>
                                    </svg>
                                    <span class="is-drawer-close:hidden">Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a class="{{ request()->is('tasks*') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }} is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="My Tasks" href="/tasks">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-linejoin="round" stroke-linecap="round" stroke-width="2" fill="none" stroke="currentColor" class="my-1.5 inline-block size-4">
                                        <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                    </svg>
                                    <span class="is-drawer-close:hidden">My Tasks</span>
                                </a>
                            </li>
                            <li>
                                <a class="{{ request()->is('workspaces*') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }} is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Projects" href="/workspaces">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-linejoin="round" stroke-linecap="round" stroke-width="2" fill="none" stroke="currentColor" class="my-1.5 inline-block size-4">
                                        <path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                    <span class="is-drawer-close:hidden">Projects</span>
                                </a>
                            </li>
                        @endif
                    @endauth
                </ul>
                
                @auth
                <div class="p-4 border-t border-gray-200">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-medium text-sm">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <div class="flex-1 is-drawer-close:hidden">
                            <div class="font-medium text-gray-900 text-sm">{{ auth()->user()->name }}</div>
                            <div class="text-xs text-gray-600">{{ auth()->user()->hasRole() }}</div>
                        </div>
                    </div>
                </div>
                @endauth
            </div>
        </div>
    </div>
</body>
