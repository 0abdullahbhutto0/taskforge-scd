<nav class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <a href="/">
                <x-logo>
                    <span class="text-xl font-bold text-gray-900">TaskForge</span>
                </x-logo>
            </a>
            @guest
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#features" class="text-gray-600 hover:text-gray-900">Features</a>
                    <a href="#workflow" class="text-gray-600 hover:text-gray-900">Workflow</a>
                    <a href="#pricing" class="text-gray-600 hover:text-gray-900">Pricing</a>
                </div>

                <div class="flex items-center space-x-4">
                    <a href="/login" class="text-gray-700 hover:text-gray-900 font-medium">Log in</a>
                    <a href="/register"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700 transition">
                        Get started free
                    </a>
                </div>
            @endguest
        </div>
    </div>
</nav>
