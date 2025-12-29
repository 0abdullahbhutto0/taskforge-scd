<x-layout>
    <!--<main style="background-image: url({{ Vite::asset('resources/images/bg-image.png') }})" class="relative min-h-screen bg-no-repeat bg-center bg-cover">-->
    <!-- Gradient Background Wrapper -->
    <div class="relative bg-gradient-to-b from-blue-100/40 via-cyan-50/30 to-rose-100/40 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-white/20 to-white/40"></div>

        <section class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-20">
            <div class="relative z-10">
                <!-- Status Badge -->
                <div class="flex justify-center mb-8">
                    <div
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/80 backdrop-blur border border-gray-200 shadow-xl">
                        <span class="inline-flex h-2 w-2 rounded-full bg-green-500 animate-pulse"></span>
                        <span class="text-sm font-medium text-gray-700">OPEN BETA IS LIVE</span>
                    </div>
                </div>

                <!-- Hero Avatars -->
                <div class="flex justify-center items-center space-x-4 mb-3">
                    <img src="{{ Vite::asset('resources/images/hero-image-preview.png') }}" alt="Hero Illustrations"
                        style="width: 600px; height: 95px">
                </div>

                <div class="text-center">
                    <h1 class="text-5xl font-bold tracking-tight sm:text-6xl md:text-7xl lg:text-8xl text-balance">
                        <span class="text-gray-900">Streamline tasks.</span>
                        <br>
                        <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">Empower
                            teams.</span>
                    </h1>

                    <p class="mx-auto mt-6 max-w-2xl text-base text-gray-600 md:text-lg text-balance leading-relaxed">
                        TaskForge is a role-based task management system that brings clarity to
                        delegation, tracking, and accountability across your entire organization.
                    </p>

                    <div
                        class="mt-10 flex flex-col sm:flex-row justify-center items-center space-y-4 sm:space-y-0 sm:space-x-4 mb-8">
                        <a href="/register"
                            class="bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition flex items-center space-x-2 shadow-lg shadow-blue-500/60 hover:shadow-blue-500/100 hover:shadow-2xl">
                            <span>Get started free</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                    </div>

                    <p class="text-gray-500 text-sm">
                         Free forever for small teams
                    </p>

                    <div class="mt-8 flex flex-col sm:flex-row justify-center gap-3 sm:gap-4">
                        <div
                            class="rounded-full bg-white/80 backdrop-blur border border-gray-200 px-4 py-2 text-sm text-gray-700 shadow-sm flex items-center gap-2">
                            <span class="inline-flex h-2 w-2 rounded-full bg-green-500"></span>
                            99.9% uptime monitored
                        </div>
                        <div
                            class="rounded-full bg-white/80 backdrop-blur border border-gray-200 px-4 py-2 text-sm text-gray-700 shadow-sm flex items-center gap-2">
                            <span class="inline-flex h-2 w-2 rounded-full bg-blue-500"></span>
                            Trusted by 120+ teams
                        </div>
                        <div
                            class="rounded-full bg-white/80 backdrop-blur border border-gray-200 px-4 py-2 text-sm text-gray-700 shadow-sm flex items-center gap-2">
                            <span class="inline-flex h-2 w-2 rounded-full bg-indigo-500"></span>
                            SOC2-ready controls
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Dashboard Preview -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 mb-20">
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-300">
            <div class="flex items-center space-x-2 mb-6">
                <div class="w-3 h-3 rounded-full bg-red-500"></div>
                <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                <div class="w-3 h-3 rounded-full bg-green-500"></div>
                <span class="ml-4 text-sm text-gray-500">taskforge.app/dashboard</span>
            </div>

            <h2 class="text-2xl font-bold text-gray-900 mb-8">Overview</h2>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="bg-white border border-gray-200 rounded-xl p-6">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="text-gray-600">Tasks Due Today</span>
                    </div>
                    <div class="text-4xl font-bold text-gray-900 mb-2">12</div>
                    <div class="text-sm text-green-600">↗ +2 from yesterday</div>
                </div>

                <div class="bg-white border border-gray-200 rounded-xl p-6">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                        </div>
                        <span class="text-gray-600">Project Completion</span>
                    </div>
                    <div class="text-4xl font-bold text-gray-900 mb-2">78%</div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-blue-600 h-2 rounded-full" style="width: 78%"></div>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 rounded-xl p-6">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <span class="text-gray-600">Bottlenecks</span>
                    </div>
                    <div class="text-4xl font-bold text-gray-900 mb-2">3</div>
                    <div class="text-sm text-orange-600">Requires attention</div>
                </div>
            </div>

            <!-- Active Projects Table -->
            <div class="border-t border-gray-200 pt-8">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-gray-900">Active Projects</h3>
                    <a href="#" class="text-blue-600 hover:text-blue-700 font-medium">View All</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">PROJECT NAME
                                </th>
                                <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">LEAD</th>
                                <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">STATUS</th>
                                <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">PROGRESS</th>
                                <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">DUE DATE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-gray-100">
                                <td class="py-4 px-4">
                                    <div class="font-semibold text-gray-900">Q3 Marketing Launch</div>
                                    <div class="text-sm text-gray-500">Marketing • High</div>
                                </td>
                                <td class="py-4 px-4">
                                    <div
                                        class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white font-semibold">
                                        S</div>
                                </td>
                                <td class="py-4 px-4">
                                    <span
                                        class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-medium">On
                                        Track</span>
                                </td>
                                <td class="py-4 px-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="flex-1 bg-gray-200 rounded-full h-2">
                                            <div class="bg-blue-600 h-2 rounded-full" style="width: 75%"></div>
                                        </div>
                                        <span class="text-sm text-gray-600">75%</span>
                                    </div>
                                </td>
                                <td class="py-4 px-4 text-gray-600">Oct 12</td>
                            </tr>
                            <tr class="border-b border-gray-100">
                                <td class="py-4 px-4">
                                    <div class="font-semibold text-gray-900">Mobile App Refactor</div>
                                    <div class="text-sm text-gray-500">Engineering • Critical</div>
                                </td>
                                <td class="py-4 px-4">
                                    <div
                                        class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center text-white font-semibold">
                                        M</div>
                                </td>
                                <td class="py-4 px-4">
                                    <span
                                        class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-medium">Blocked</span>
                                </td>
                                <td class="py-4 px-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="flex-1 bg-gray-200 rounded-full h-2">
                                            <div class="bg-red-500 h-2 rounded-full" style="width: 45%"></div>
                                        </div>
                                        <span class="text-sm text-gray-600">45%</span>
                                    </div>
                                </td>
                                <td class="py-4 px-4 text-gray-600">Oct 28</td>
                            </tr>
                            <tr class="border-b border-gray-100">
                                <td class="py-4 px-4">
                                    <div class="font-semibold text-gray-900">Website Redesign</div>
                                    <div class="text-sm text-gray-500">Design • Normal</div>
                                </td>
                                <td class="py-4 px-4">
                                    <div
                                        class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center text-white font-semibold">
                                        A</div>
                                </td>
                                <td class="py-4 px-4">
                                    <span
                                        class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-medium">Review</span>
                                </td>
                                <td class="py-4 px-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="flex-1 bg-gray-200 rounded-full h-2">
                                            <div class="bg-yellow-500 h-2 rounded-full" style="width: 90%"></div>
                                        </div>
                                        <span class="text-sm text-gray-600">90%</span>
                                    </div>
                                </td>
                                <td class="py-4 px-4 text-gray-600">Oct 25</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="bg-white py-20">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <p class="text-blue-600 font-semibold mb-3">Features</p>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Built for clarity and accountability
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Every role has distinct permissions. Every task has clear ownership. Overseer brings order to
                    your
                    workflow.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gray-50 rounded-xl p-8">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Admin Control</h3>
                    <p class="text-gray-600">
                        Oversee the entire system, manage users, assign roles, and access comprehensive dashboards.
                    </p>
                </div>

                <div class="bg-gray-50 rounded-xl p-8">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Manager Workflow</h3>
                    <p class="text-gray-600">
                        Create and delegate tasks with priority levels, deadlines, and real-time team progress
                        tracking.
                    </p>
                </div>

                <div class="bg-gray-50 rounded-xl p-8">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Employee Focus</h3>
                    <p class="text-gray-600">
                        Clear view of assigned tasks with status updates, comments, and progress notes.
                    </p>
                </div>

                <div class="bg-gray-50 rounded-xl p-8">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Visual Analytics</h3>
                    <p class="text-gray-600">
                        Track productivity with intuitive dashboards showing task completion and team performance.
                    </p>
                </div>

                <div class="bg-gray-50 rounded-xl p-8">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Fast & Responsive</h3>
                    <p class="text-gray-600">
                        Optimized for speed with page loads under 2 seconds and seamless interactions.
                    </p>
                </div>

                <div class="bg-gray-50 rounded-xl p-8">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Secure by Design</h3>
                    <p class="text-gray-600">
                        Role-based access control, CSRF protection, and input validation built-in.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Workflow Section -->
    <section id="workflow" class="bg-gray-50 py-20">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <p class="text-blue-600 font-semibold mb-3">Workflow</p>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Clear hierarchy, clear results</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Three distinct roles with well-defined responsibilities ensure smooth task flow from creation to
                    completion.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl p-8 shadow-sm">
                    <div class="w-16 h-16 bg-blue-600 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Admin</h3>
                    <p class="text-gray-600 mb-6">Manage users, assign roles, and oversee system-wide operations
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <span class="w-1.5 h-1.5 bg-blue-600 rounded-full mt-2 mr-3"></span>
                            <span class="text-gray-700">Create & manage users</span>
                        </li>
                        <li class="flex items-start">
                            <span class="w-1.5 h-1.5 bg-blue-600 rounded-full mt-2 mr-3"></span>
                            <span class="text-gray-700">Assign Manager roles</span>
                        </li>
                        <li class="flex items-start">
                            <span class="w-1.5 h-1.5 bg-blue-600 rounded-full mt-2 mr-3"></span>
                            <span class="text-gray-700">View all tasks & projects</span>
                        </li>
                    </ul>
                </div>

                <div class="bg-white rounded-2xl p-8 shadow-sm relative">
                    <div
                        class="hidden md:block absolute -left-4 top-1/2 transform -translate-y-1/2 -translate-x-full text-gray-200">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </div>

                    <div class="w-16 h-16 bg-amber-500 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Manager</h3>
                    <p class="text-gray-600 mb-6">Lead your team with powerful task creation and delegation tools
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <span class="w-1.5 h-1.5 bg-amber-500 rounded-full mt-2 mr-3"></span>
                            <span class="text-gray-700">Create & assign tasks</span>
                        </li>
                        <li class="flex items-start">
                            <span class="w-1.5 h-1.5 bg-amber-500 rounded-full mt-2 mr-3"></span>
                            <span class="text-gray-700">Set priorities & deadlines</span>
                        </li>
                        <li class="flex items-start">
                            <span class="w-1.5 h-1.5 bg-amber-500 rounded-full mt-2 mr-3"></span>
                            <span class="text-gray-700">Track team progress</span>
                        </li>
                    </ul>
                </div>

                <div class="bg-white rounded-2xl p-8 shadow-sm relative">
                    <div
                        class="hidden md:block absolute -left-4 top-1/2 transform -translate-y-1/2 -translate-x-full text-gray-200">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </div>

                    <div class="w-16 h-16 bg-green-500 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Employee</h3>
                    <p class="text-gray-600 mb-6">Focus on what matters with a clear view of your responsibilities
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <span class="w-1.5 h-1.5 bg-green-500 rounded-full mt-2 mr-3"></span>
                            <span class="text-gray-700">View assigned tasks</span>
                        </li>
                        <li class="flex items-start">
                            <span class="w-1.5 h-1.5 bg-green-500 rounded-full mt-2 mr-3"></span>
                            <span class="text-gray-700">Update task status</span>
                        </li>
                        <li class="flex items-start">
                            <span class="w-1.5 h-1.5 bg-green-500 rounded-full mt-2 mr-3"></span>
                            <span class="text-gray-700">Add progress notes</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    </main>
    <section class="w-full bg-[#0F172A] py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-full mx-auto text-center">
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-6 tracking-tight">
                Ready to streamline your workflow?
            </h2>

            <p class="text-lg text-blue-200/80 mb-10 max-w-2xl mx-auto leading-relaxed">
                Join teams who trust TaskForge to bring clarity to their task management. Start free and scale as
                you
                grow.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
                <a href="#"
                    class="group bg-[#FDFBF7] text-[#0F172A] px-8 py-3.5 rounded-lg font-semibold hover:bg-white transition-all duration-200 flex items-center gap-2">
                    Get started free
                    <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>

                <a href="#" class="text-white font-medium hover:text-blue-200 transition-colors">
                    Talk to sales
                </a>
            </div>
        </div>
    </section>

    <footer class="bg-[#FDFBF7] border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex flex-col md:flex-row items-center justify-between gap-8 md:gap-0">

                <div class="flex items-center gap-2">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 100 100">
                            <rect width="100" height="100" rx="20" fill="#007bff" />
                            <path d="M 25 25 L 75 25 L 75 35 L 55 35 L 55 75 L 45 75 L 45 35 L 25 35 Z"
                                fill="#ffffff" />
                            <path d="M 30 40 L 70 40 L 70 45 L 30 45 Z" fill="#ffffff" opacity="0.7" />
                            <path d="M 35 50 L 65 50 L 65 55 L 35 55 Z" fill="#ffffff" opacity="0.5" />
                            <path d="M 40 60 L 60 60 L 60 65 L 40 65 Z" fill="#ffffff" opacity="0.3" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-gray-900">TaskForge</span>
                </div>

                <nav class="flex flex-wrap justify-center gap-8">
                    <a href="#"
                        class="text-gray-500 hover:text-blue-600 font-medium transition-colors">Features</a>
                    <a href="#"
                        class="text-gray-500 hover:text-blue-600 font-medium transition-colors">Workflow</a>
                    <a href="#"
                        class="text-gray-500 hover:text-blue-600 font-medium transition-colors">Pricing</a>
                    <a href="#"
                        class="text-gray-500 hover:text-blue-600 font-medium transition-colors">Documentation</a>
                    <a href="#"
                        class="text-gray-500 hover:text-blue-600 font-medium transition-colors">Support</a>
                </nav>

                <div class="text-gray-400 text-sm">
                    &copy; 2026 TaskForge. All rights reserved.
                </div>

            </div>
        </div>
    </footer>
</x-layout>
