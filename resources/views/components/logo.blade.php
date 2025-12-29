<div class="flex items-center space-x-2">
    <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100">
            <rect width="100" height="100" rx="20" fill="#007bff" />
            <path d="M 25 25 L 75 25 L 75 35 L 55 35 L 55 75 L 45 75 L 45 35 L 25 35 Z" fill="#ffffff" />
            <path d="M 30 40 L 70 40 L 70 45 L 30 45 Z" fill="#ffffff" opacity="0.7" />
            <path d="M 35 50 L 65 50 L 65 55 L 35 55 Z" fill="#ffffff" opacity="0.5" />
            <path d="M 40 60 L 60 60 L 60 65 L 40 65 Z" fill="#ffffff" opacity="0.3" />
        </svg>
    </div>
    {{ $slot }}
    <!--<span class="text-xl font-bold text-gray-900">TaskForge</span>-->
</div>
