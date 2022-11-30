@props([
    'id' => '',
    'title' => '',
])
{{ $slot }}
<div role="tooltip" id="{{ $id }}" class="inline-block absolute invisible z-10 py-1 px-2 text-xs font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip dark:bg-gray-700">
    <span>{{ $title }}</span>
    <div class="tooltip-arrow" data-popper-arrow></div>
</div>
