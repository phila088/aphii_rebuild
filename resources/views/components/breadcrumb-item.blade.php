@props (['label', 'url'])

<li class="inline-flex items-center">
    <a class="flex items-center text-xs text-gray-800 hover:text-blue-600 focus:outline-none focus:text-blue-600 dark:focus:text-blue-500" href="{{ $url }}">
        {{ $label }}
    </a>
    <svg class="flex-shrink-0 mx-2 overflow-visible size-3 text-gray-800 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="m9 18 6-6-6-6"></path>
    </svg>
</li>
