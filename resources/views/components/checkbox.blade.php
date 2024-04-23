@props (['id', 'label', 'model', 'live' => 'true'])

    <input type="checkbox" class="checkbox" id="{{ $id }}">
    <label for="{{ $id }}" class="text-sm text-gray-500 ms-3 dark:text-neutral-400">{{ $label }}</label>
