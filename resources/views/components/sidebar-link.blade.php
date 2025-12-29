@props(['active' => false])
<a {{ $attributes->merge(['class' => ($active ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600') . ' is-drawer-close:tooltip is-drawer-close:tooltip-right']) }} data-tip="{{ $slot }}" href="/invites" {{ $attributes }}>
    <!-- Settings icon -->
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-linejoin="round" stroke-linecap="round"
        stroke-width="2" fill="none" stroke="currentColor" class="my-1.5 inline-block size-4">
        <path d="M20 7h-9"></path>
        <path d="M14 17H5"></path>
        <circle cx="17" cy="17" r="3"></circle>
        <circle cx="7" cy="7" r="3"></circle>
    </svg>
    <span class="is-drawer-close:hidden">{{ $slot }}</span>
</a>
